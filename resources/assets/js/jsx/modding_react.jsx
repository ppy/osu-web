/**
*  Copyright 2015 ppy Pty. Ltd.
*
*  This file is part of osu!web. osu!web is distributed with the hope of
*  attracting more community contributions to the core ecosystem of osu!.
*
*  osu!web is free software: you can redistribute it and/or modify
*  it under the terms of the Affero GNU General Public License as published by
*  the Free Software Foundation, either version 3 of the License, or
*  (at your option) any later version.
*
*  osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*  warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*  See the GNU Affero General Public License for more details.
*
*  You should have received a copy of the GNU Affero General Public License
*  along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
*/
var endpoint = "modding";

var TopicController = React.createClass({
  loadCommentsFromServer: function() {
    $.ajax({
      url: this.props.url,
      dataType: 'json',
      success: function(data) {
        this.setState({posts: data});
      }.bind(this),
      error: function(xhr, status, err) {
        console.error(this.props.url, status, err.toString());
      }.bind(this)
    });
  },
  componentWillMount: function() {
    this.loadCommentsFromServer();
    setInterval(this.loadCommentsFromServer, 30000);
  },
  getInitialState: function() {
    return { posts: [] };
  },
  findPost: function(id, p) {
    if (p.post_id === id) return p;
    if (!p.posts) return null;
    for (var i in p.posts)
    {
      var q = this.findPost(id, p.posts[i]);
      if (q !== null) return q;
    }

    return null;
  },
  handleNewPost: function(data) {
    var state = this.state;

    var post = this.findPost(data.parent, state.posts);

    if (post !== null)
    {
      if (!post.posts)
        post.posts = [];

      post.posts.push({user: user, text: data.text});
    }

    $.post( "/"+endpoint+"?_token=" + window.csrf, data)
      .done($.proxy(function(data) {
        this.loadCommentsFromServer();
      }, this));

    this.setState(state);
  },
  render: function() {

    var pendingCount = 0;
    var resolvedCount = 0;

    if (this.state.posts && this.state.posts.posts)
    {
      this.state.posts.posts.forEach(function (post) {
        switch (post.type)
        {
          default:
            resolvedCount++;
            break;
            case 'pending':
            case 'resolved':
        }
      });
    }

    var totalCount = pendingCount + resolvedCount;

    return (
      <div>
        <div className="row">
          <div className="col-xs-3"></div>
          <IssueCounter title="Resolved" count={resolvedCount} />
          <IssueCounter title="Pending" count={pendingCount} />
          <IssueCounter title="Total" count={totalCount} />
        </div>
        <div className="row">
          <Timeline />
        </div>
        <div className="row">
          <div className="topic col-md-9">
            <Post key={this.state.posts.post_id} data={this.state.posts} handleNewPost={this.handleNewPost} />
          </div>
          <div className="col-md-3">
            <PostUserFilter data={this.state.posts} />
          </div>
        </div>
      </div>
    );
  },
});

var IssueCounter = React.createClass({
  render: function() {
    var cl = this.props.title.toLowerCase();

    return (
      <div className="col-xs-3">
        <div className={"counter " + cl}>
          <div className="title">{this.props.title}</div>
          <div className="number" id={"totals-" + cl}>{this.props.count}</div>
        </div>
      </div>
    );
  }
});

var Timeline = React.createClass({

  render: function() {
    return (
      <div className="col-xs-12">
        <div className="scrubbar"></div>
      </div>
    );
  }

});

var Post = React.createClass({
  handleNewPost: function(data) {
    this.props.handleNewPost(data);
  },
  render: function() {
    if (!this.props.data.user) return <div>Loading posts...</div>;

    var callback = this.handleNewPost;
    var children = this.props.data.posts ? this.props.data.posts.map(function (post) { return <Post key={post.post_id} data={post} child="true" handleNewPost={callback} />; }) : '';
    var postform;

    if (this.props.data.depth < 2)
      postform = <PostForm parentId={this.props.data.post_id} handleNewPost={this.handleNewPost} />;
    else
      postform = <div />;

    var className = "post" + (this.props.child ? " child" : " toplevel");

    return (
      <div className={className}>
        {this.props.data.user.username} says "{this.props.data.text}"
        {children}
        {postform}
      </div>);
  }
});

var PostForm = React.createClass({
  handleSubmit: function() {
    var text = this.refs.text.getDOMNode().value.trim();
    if (!text) return false;

    this.props.handleNewPost({text: text, parent: this.props.parentId});
    this.refs.text.getDOMNode().value = '';
    return false;
  },
  render: function() {
    return (
      <form className="post child form" onSubmit={this.handleSubmit}>
        <div className="form-group">
          <textarea className="form-control" type="text" placeholder="Type here to reply..." ref="text" />
        </div>
        <div className="form-group">
          <button type="submit" className="btn btn-primary">Post</button>
        </div>
      </form>
    );
  }
});

var PostUserFilter = React.createClass({
  render: function() {

    var users = [];

    var allUser = { user_id : 0, username : 'All', count_pending : 0, count_resolved : 0 };

    users[0] = allUser;

    var posts = this.props.data.posts;
    if (posts)
    {
      for (var i in posts)
      {
        var user = posts[i].user;
        if (!user) continue;

        if (users[user.user_id])
        {
          users[user.user_id].count_pending++;
          users[user.user_id].count_resolved++;
        }
        else
        {
          users[user.user_id] = user;
          users[user.user_id].count_pending = 1;
          users[user.user_id].count_resolved = 1;
        }

        allUser.count_pending++;
        allUser.count_resolved++;
      }
    }

    users.sort(function(a,b) { return b.count_pending - a.count_pending; } );

    var filters = users.map(function (user) { return <UserFilterItem key={user.user_id} user={user} />; });

    return (
      <table className="table table-condensed table-hover" id="stats-table">
        <tbody>
          {filters}
        </tbody>
      </table>
    );
  }

});

var UserFilterItem = React.createClass({

  render: function() {
    return (
      <tr className="active">
        <td>{this.props.user.username}</td>
        <td className="text-right">
          <span className="green-dark">
            <i className="fa fa-check-circle-o"></i> <span id="session-resolved">{this.props.user.count_resolved}</span>
          </span>
          &nbsp;
          <span className="pink-darker">
            <i className="fa fa-times-circle-o"></i> <span id="session-pending">{this.props.user.count_pending}</span>
          </span>
        </td>
      </tr>
    );
  }

});

React.render(<TopicController url={"/" + endpoint + "/1"} />, $('#topics')[0]);
