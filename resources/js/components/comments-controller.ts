// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CommentJson, { CommentableMetaJson, CommentBundleJson } from 'interfaces/comment-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { isEqual, last } from 'lodash';
import { action, makeObservable, observable, runInAction } from 'mobx';
import Comment from 'models/comment';
import core from 'osu-core-singleton';
import { onError } from 'utils/ajax';
import { trans } from 'utils/lang';
import { switchNever } from 'utils/switch-never';

export interface BaseCommentableMeta {
  id: number;
  type: string;
}

export type CommentEditMode = 'edit' | 'new' | 'reply';

export interface PostParams {
  commentableMeta?: CommentableMetaJson;
  id?: number;
  message: string;
  mode: CommentEditMode;
  parentId?: number;
}

interface State {
  commentableMetaItems: Partial<Record<string, CommentableMetaJson>>;
  commentIdsByParentId: Partial<Record<number, number[]>>;
  comments: Partial<Record<number, Comment>>;
  hasMore: Partial<Record<number, boolean>>;
  isFollowing: boolean; // only for the first commentableMetaItem
  pinnedCommentIds: number[];
  sort: string;
  topLevelCount: number;
  total: number;
  users: Partial<Record<number, UserJson>>;
  votedCommentIds: Set<number>;
}

interface StateJson {
  commentableMetaItems: Partial<Record<string, CommentableMetaJson>>;
  commentIdsByParentId: Partial<Record<number, number[]>>;
  comments: CommentJson[];
  hasMore: Partial<Record<number, boolean>>;
  isFollowing: boolean;
  pinnedCommentIds: number[];
  sort: string;
  topLevelCount: number;
  total: number;
  users: Partial<Record<number, UserJson>>;
  votedCommentIds: number[];
}

interface XhrCollection {
  [Delete: `delete-${number}`]: JQuery.jqXHR<CommentBundleJson>;
  [Load: `load-${number}`]: JQuery.jqXHR<CommentBundleJson>;
  [Pin: `pin-${number}`]: JQuery.jqXHR<CommentBundleJson>;
  [Post: `${CommentEditMode}-${number | string}`]: JQuery.jqXHR<CommentBundleJson>;
  [Vote: `vote-${number}`]: JQuery.jqXHR<CommentBundleJson>;
  follow: JQuery.jqXHR<void>;
  sort: JQuery.jqXHR<CommentBundleJson>;
}

interface XhrPostParams {
  comment: {
    commentable_id?: number;
    commentable_type?: string;
    message: string;
    parent_id?: number;
  };
}

function abortXhrCollection(xhrCollection: Partial<Record<string, JQuery.jqXHR<unknown>>>) {
  Object.values(xhrCollection).forEach((xhr) => xhr?.abort());
}

function initialState() {
  return {
    commentableMetaItems: {},
    commentIdsByParentId: {},
    comments: {},
    hasMore: {},
    isFollowing: false,
    pinnedCommentIds: [],
    sort: 'new',
    topLevelCount: 0,
    total: 0,
    users: {},
    votedCommentIds: new Set<number>(),
  };
}

function makeMetaId(meta: BaseCommentableMeta | CommentableMetaJson | undefined) {
  return meta != null && 'id' in meta
    ? `${meta.type}-${meta.id}`
    : 'null';
}

function postXhrKeyId(postParams: PostParams) {
  switch (postParams.mode) {
    case 'edit':
      return postParams.id ?? 0;
    case 'new':
      return makeMetaId(postParams.commentableMeta);
    case 'reply':
      return postParams.parentId ?? 0;
    default:
      switchNever(postParams.mode);
      throw new Error('unsupported mode');
  }
}

export default class CommentsController {
  @observable nextState: Partial<State> = {};
  @observable state: State;

  private destroyed = false;
  @observable private xhr: Partial<XhrCollection> = {};

  get commentableMeta() {
    return this.state.commentableMetaItems[makeMetaId(this.baseCommentableMeta)];
  }

  get pinnedComments() {
    return this.getComments(this.state.pinnedCommentIds);
  }

  get stateEl() {
    const ret = (window.newBody ?? document.body).querySelector(this.stateSelector);

    if (ret instanceof HTMLScriptElement) {
      return ret;
    }

    throw new Error('missing state element');
  }

  get topLevelComments() {
    return this.getComments(this.state.commentIdsByParentId[0] ?? []);
  }

  constructor(private readonly stateSelector: string, private readonly baseCommentableMeta?: BaseCommentableMeta) {
    const stateEl = this.stateEl;
    const savedStateJson = stateEl.dataset.savedState;
    if (savedStateJson != null) {
      this.state = this.stateFromJson(JSON.parse(savedStateJson) as StateJson);
    } else {
      this.state = initialState();
      const initialBundle = JSON.parse(stateEl.text) as CommentBundleJson;
      this.loadBundle(initialBundle, true, true);
    }

    makeObservable(this);

    document.addEventListener('turbo:before-cache', this.destroy);
  }

  @action
  apiDelete(comment: Comment) {
    if (this.isDeleting(comment) || !confirm(trans('common.confirmation'))) return;

    const xhrKey = `delete-${comment.id}` as const;
    this.xhr[xhrKey] = $.ajax(route('comments.destroy', { comment: comment.id }), { method: 'DELETE' });

    this.xhr[xhrKey]
      ?.done((bundle) => this.loadBundle(bundle))
      .fail(onError)
      .always(action(() => {
        delete(this.xhr[xhrKey]);
      }));
  }

  @action
  apiLoadMore(parent: Comment | null | undefined) {
    if (this.isLoading(parent)) return;

    const parentId = parent?.id ?? 0;

    const params: Partial<Record<string, unknown>> = {
      parent_id: parentId,
      sort: this.state.sort,
    };

    if (parent == null) {
      if (this.baseCommentableMeta != null) {
        params.commentable_id = this.baseCommentableMeta.id;
        params.commentable_type = this.baseCommentableMeta.type;
      }
    } else {
      params.commentable_id = parent.commentableId;
      params.commentable_type = parent.commentableType;
    }

    const lastCommentId = last(this.state.commentIdsByParentId[parentId] ?? []);
    if (lastCommentId != null) {
      params.after = lastCommentId;
    }

    const xhrKey = `load-${parentId}` as const;
    this.xhr[xhrKey] = $.ajax(route('comments.index'), { data: params, dataType: 'json' });
    this.xhr[xhrKey]
      ?.done((bundle) => this.loadBundle(bundle))
      .always(action(() => {
        delete(this.xhr[xhrKey]);
      }));
  }

  @action
  apiPost(postParams: PostParams, doneCallback: () => void) {
    if (this.isPosting(postParams)) return;

    if (core.userLogin.showIfGuest(() => this.apiPost(postParams, doneCallback))) return;

    const params: XhrPostParams = {
      comment: { message: postParams.message },
    };

    let url = route('comments.store');
    let method = 'POST';

    switch (postParams.mode) {
      case 'edit':
        if (postParams.id == null) {
          throw new Error('missing post id in edit mode');
        }
        url = route('comments.update', { comment: postParams.id });
        method = 'PUT';
        break;

      case 'new':
        if (postParams.commentableMeta == null || !('id' in postParams.commentableMeta)) {
          throw new Error('missing commentable meta in new mode');
        }
        params.comment.commentable_type = postParams.commentableMeta.type;
        params.comment.commentable_id = postParams.commentableMeta.id;
        break;

      case 'reply':
        if (postParams.parentId == null) {
          throw new Error('missing parent in reply mode');
        }
        params.comment.parent_id = postParams.parentId;
        break;

      default:
        switchNever(postParams.mode);
        throw new Error('unsupported mode');
    }

    const xhrKey = `${postParams.mode}-${postXhrKeyId(postParams)}` as const;

    this.xhr[xhrKey] = $.ajax(url, { data: params, method });
    this.xhr[xhrKey]
      ?.always(action(() => {
        delete(this.xhr[xhrKey]);
      })).done((bundle) => runInAction(() => {
        doneCallback();
        this.loadBundle(bundle, false);
      })).fail(onError);
  }

  @action
  apiRestore(comment: Comment) {
    if (this.isDeleting(comment) || !confirm(trans('common.confirmation'))) {
      return;
    }

    const xhrKey = `delete-${comment.id}` as const;
    this.xhr[xhrKey] = $.ajax(route('comments.restore', { comment: comment.id }), { method: 'POST' });

    this.xhr[xhrKey]
      ?.done((bundle) => this.loadBundle(bundle))
      .fail(onError)
      .always(action(() => {
        delete(this.xhr[xhrKey]);
      }));
  }

  @action
  apiSetSort(sort: string) {
    if (this.xhr.sort != null) return;

    this.nextState.sort = sort;

    const params: Record<string, unknown> = {
      parent_id: 0,
      sort,
    };
    if (this.commentableMeta != null && 'id' in this.commentableMeta) {
      params.commentable_id = this.commentableMeta.id;
      params.commentable_type = this.commentableMeta.type;
    }

    this.xhr.sort = $.ajax(route('comments.index'), {
      data: params,
      dataType: 'json',
    });
    this.xhr.sort
      .done((bundle) => runInAction(() => {
        abortXhrCollection(this.xhr);
        this.state = initialState();
        this.nextState = {};
        this.xhr = {};
        this.loadBundle(bundle, true, true);
        core.userPreferences.set('comments_sort', this.state.sort);
      }));
  }

  @action
  apiToggleFollow() {
    if (this.nextState.isFollowing != null) return;

    const meta = this.commentableMeta;

    if (meta == null || !('id' in meta)) return;

    const isFollowing = this.nextState.isFollowing = !this.state.isFollowing;

    this.xhr.follow = $.ajax(route('follows.store'), {
      data: {
        follow: {
          notifiable_id: meta.id,
          notifiable_type: meta.type,
          subtype: 'comment',
        },
      },
      dataType: 'json',
      method: this.nextState.isFollowing ? 'POST' : 'DELETE',
    });
    this.xhr.follow
      .always(action(() => {
        delete(this.xhr.follow);
        this.nextState.isFollowing = undefined;
      })).done(action(() => {
        this.state.isFollowing = isFollowing;
      })).fail(onError);
  }

  @action
  apiTogglePin(comment: Comment) {
    const xhrKey = `pin-${comment.id}` as const;
    if (this.xhr[xhrKey] != null || !comment.canPin) {
      return;
    }

    this.xhr[xhrKey] = $.ajax(route('comments.pin', { comment: comment.id }), {
      method: comment.pinned ? 'DELETE' : 'POST',
    });
    this.xhr[xhrKey]
      ?.done((bundle) => this.loadBundle(bundle))
      .fail(onError)
      .always(action(() => {
        delete(this.xhr[xhrKey]);
      }));
  }

  @action
  apiToggleVote(comment: Comment) {
    if (this.isVoting(comment)) return;

    if (core.userLogin.showIfGuest(() => this.apiToggleVote(comment))) return;

    let method: string;
    let storeMethod: 'add' | 'delete';

    if (this.state.votedCommentIds.has(comment.id)) {
      method = 'DELETE';
      storeMethod = 'delete';
    } else {
      method = 'POST';
      storeMethod = 'add';
    }

    const xhrKey = `vote-${comment.id}` as const;
    this.xhr[xhrKey] = $.ajax(route('comments.vote', { comment: comment.id }), { method });
    this.xhr[xhrKey]
      ?.done((bundle) => runInAction(() => {
        this.loadBundle(bundle);
        this.state.votedCommentIds[storeMethod](comment.id);
      })).fail(onError)
      .always(action(() => {
        delete(this.xhr[xhrKey]);
      }));
  }

  readonly destroy = () => {
    if (this.destroyed) return;

    document.removeEventListener('turbo:before-cache', this.destroy);
    abortXhrCollection(this.xhr);
    this.stateStore();
    this.destroyed = true;
  };

  getCommentableMeta(comment: Comment) {
    return this.state.commentableMetaItems[`${comment.commentableType}-${comment.commentableId}`] ?? { title: '' };
  }

  getComments(ids: number[] | undefined) {
    const ret = [];

    for (const id of ids ?? []) {
      const comment = this.state.comments[id];

      if (comment != null) {
        ret.push(comment);
      }
    }

    return ret;
  }

  getReplies(comment: Comment) {
    const ids = this.state.commentIdsByParentId[comment.id];

    return this.getComments(ids);
  }

  getUser(id: number | null | undefined) {
    return id == null ? undefined : this.state.users[id];
  }

  isLoading(parent: Comment | null | undefined) {
    return this.xhr[`load-${parent?.id ?? 0}`] != null;
  }

  isPosting(postParams: PostParams) {
    return this.xhr[`${postParams.mode}-${postXhrKeyId(postParams)}`] != null;
  }

  isVoting(comment: Comment) {
    return this.xhr[`vote-${comment.id}`] != null;
  }

  private addComment(commentJson: CommentJson) {
    const id = commentJson.id;
    if (this.state.comments[id]?.updatedAt !== commentJson.updated_at) {
      this.state.comments[id] = new Comment(commentJson, this);
    }
  }

  private addCommentId(comment: CommentJson, append: boolean) {
    const parentId = comment.parent_id ?? 0;
    this.state.commentIdsByParentId[parentId] ??= [];

    // The `?? []` shouldn't ever happen.
    const ids = this.state.commentIdsByParentId[parentId] ?? [];
    const newId = comment.id;
    if (!ids.includes(newId)) {
      if (append) {
        ids.push(newId);
      } else {
        ids.unshift(newId);
      }
    }
  }

  private isDeleting(comment: Comment) {
    return this.xhr[`delete-${comment.id}`] != null;
  }

  @action
  private loadBundle(bundle: CommentBundleJson, append = true, initial = false) {
    if (initial) {
      // for initial page of comment index and show
      this.state.commentIdsByParentId[-1] = bundle.comments.map((comment) => comment.id);
      this.state.sort = bundle.sort;
      append = true;
    }

    bundle.comments.forEach((comment) => {
      this.addCommentId(comment, append);
      this.addComment(comment);
    });

    bundle.included_comments.forEach((comment) => {
      this.addCommentId(comment, true);
      this.addComment(comment);
    });
    this.state.pinnedCommentIds = [];
    (bundle.pinned_comments ?? []).forEach((comment) => {
      this.state.pinnedCommentIds.push(comment.id);
      this.addComment(comment);
    });

    bundle.user_votes.forEach((v) => this.state.votedCommentIds.add(v));

    this.state.isFollowing = bundle.user_follow;
    this.state.hasMore[bundle.has_more_id] = bundle.has_more;
    if (bundle.top_level_count != null && bundle.total != null) {
      this.state.topLevelCount = bundle.top_level_count;
      this.state.total = bundle.total;
    }

    for (const user of bundle.users) {
      const id = user.id;
      if (!isEqual(this.state.users[id], user)) {
        this.state.users[id] = user;
      }
    }
    for (const meta of bundle.commentable_meta) {
      const id = makeMetaId(meta);
      if (!isEqual(this.state.commentableMetaItems[id], meta)) {
        this.state.commentableMetaItems[id] = meta;
      }
    }
  }

  @action
  private stateFromJson(json: StateJson): State {
    const comments: State['comments'] = {};
    for (const commentJson of json.comments) {
      comments[commentJson.id] = new Comment(commentJson, this);
    }

    return {
      commentableMetaItems: json.commentableMetaItems,
      commentIdsByParentId: json.commentIdsByParentId,
      comments,
      hasMore: json.hasMore,
      isFollowing: json.isFollowing,
      pinnedCommentIds: json.pinnedCommentIds,
      sort: json.sort,
      topLevelCount: json.topLevelCount,
      total: json.total,
      users: json.users,
      votedCommentIds: new Set(json.votedCommentIds),
    };
  }

  @action
  private stateStore() {
    const comments: StateJson['comments'] = [];
    for (const commentModel of Object.values(this.state.comments)) {
      if (commentModel != null) {
        comments.push(commentModel.toJson());
      }
    }

    const json: StateJson = {
      commentableMetaItems: this.state.commentableMetaItems,
      commentIdsByParentId: this.state.commentIdsByParentId,
      comments,
      hasMore: this.state.hasMore,
      isFollowing: this.state.isFollowing,
      pinnedCommentIds: this.state.pinnedCommentIds,
      sort: this.state.sort,
      topLevelCount: this.state.topLevelCount,
      total: this.state.total,
      users: this.state.users,
      votedCommentIds: [...this.state.votedCommentIds],
    };

    this.stateEl.dataset.savedState = JSON.stringify(json);
  }
}
