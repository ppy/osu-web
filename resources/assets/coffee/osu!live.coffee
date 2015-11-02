###
Copyright 2015 ppy Pty. Ltd.

This file is part of osu!web. osu!web is distributed with the hope of
attracting more community contributions to the core ecosystem of osu!.

osu!web is free software: you can redistribute it and/or modify
it under the terms of the Affero GNU General Public License version 3
as published by the Free Software Foundation.

osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
###
# osu!live.js
#    - Take a JSON feed and make it live.
#    - Requires jQuery.
###

# dependency shim for array.remove("value");
# class constructor for osu!live
# usage: var   something = new Live(url, settings);
# 				something.start();

Live = (feed, settings) ->
  liveSettings = 
    update: 'PUT'
    token: null
    crud:
      create: 'creates'
      update: 'updates'
      delete: 'deletes'
    interval: 30
    parents: 'comments'
    children: 'replies'
    live: true
    child: null
    parent: null
    csrf: 'csrf'
    updated: 'updated'
    callbacks:
      beforeChildUpdate: null
      beforeChildDelete: null
      beforeChildCreate: null
      beforeParentUpdate: null
      beforeParentDelete: null
      beforeParentCreate: null
      beforeFetch: null
      afterChildUpdate: null
      afterChildDelete: null
      afterChildCreate: null
      afterParentUpdate: null
      afterParentDelete: null
      afterParentCreate: null
      afterFetch: null
  if settings
    # merge user-provided settings in
    $.extend liveSettings, settings
  @settings = liveSettings
  @feed = feed
  @keys =
    parents: []
    children: []
  @time = 0
  return

Array::remove = ->
  what = undefined
  a = arguments
  L = a.length
  ax = undefined
  while L and @length
    what = a[--L]
    while (ax = @indexOf(what)) != -1
      @splice ax, 1
  this

# ajax start, adding an async promise as this.response

Live::start = ->
  defer = $.Deferred()
  self = this
  data = 
    _method: self.settings.update
    _token: self.settings.token
    time: self.time
  data[self.settings.parents] = self.keys.parents.join(',')
  data[self.settings.children] = self.keys.children.join(',')
  @debug_data = data
  $.ajax
    url: self.feed
    data: data
    dataType: 'json'
    type: 'POST'
    success: (data) ->
      defer.resolve data
      return
    error: (error) ->
      console.log error
      return
  self.response = defer.promise()
  self.callback 'beforeFetch'
  if self.settings.live and !@timer
    self.live()
  else
    self.fetch()
  return

# adds a timer to this.fetch if not already set.

Live::live = ->
  @fetch()
  @timer = setInterval(((self) ->
    ->
      self.start()
      return
  )(this), @settings.interval * 1000)
  return

# handles the async promise and enables the rest of this 
# to be synchronous code with no dodgy callbacks.

Live::fetch = ->
  self = this
  @response.done((data) ->
    if data.error
      self.stop()
      console.log data.error
    else
      self.populate data
    return
  ).fail (data) ->
    console.log data
    return
  return

# stops the timer for this.live();

Live::stop = ->
  if @timer
    clearInterval @timer
    @timer = null
  return

# populates the parent and child objects as a json feed.

Live::populate = (data) ->
  @data = data
  # update security tokens, etc.
  @settings.token = @data[@settings.csrf]
  @time = data.time
  @updated = @data[@settings.updated]
  if @updated
    @create()
    @update()
    @delete()
  @callback 'afterFetch'
  return

# delete all feed-provided keys

Live::delete = ->
  parents = @data[@settings.parents][@settings.crud.delete]
  children = @data[@settings.children][@settings.crud.delete]
  i = 0
  j = 0
  i = 0
  while i < children.length
    @callback 'beforeChildDelete', children[i]
    $('#' + children[i]).remove()
    @keys.children.remove children[i]
    @callback 'afterChildDelete', children[i]
    i++
  j = 0
  while j < parents.length
    @callback 'beforeParentDelete', parent[j]
    $('#' + parents[j]).remove()
    @keys.parents.remove parents[j]
    @callback 'afterParentDelete', parent[j]
    j++
  return

# update existing elements

Live::update = ->
  parents = @data[@settings.parents][@settings.crud.update]
  children = @data[@settings.children][@settings.crud.update]
  # in order to support updating, a template of how the target
  # was originally modified is needed (data-template) must be generated
  # by this.replace or something. I'm going to inline-replace the object for now.
  if parents != false
    for key of parents
      @callback 'beforeParentUpdate', key
      @add $('#' + key), parents[key]
      @callback 'afterParentUpdate', key
  if children != false
    for _key of children
      for child of children
        @callback 'beforeChildUpdate', child
        @add $('#' + child), children[child]
        @callback 'afterChildUpdate', child
  return

# create new elements

Live::create = ->
  window.test = @data
  parents = @data[@settings.parents][@settings.crud.create]
  children = @data[@settings.children][@settings.crud.create]
  if parents != false
    for key of parents
      # handle potential weirdness...
      @keys.parents.remove key
      # add key so we dont update it again
      @keys.parents.push key
      @callback 'beforeParentCreate', key
      @attach @add(@settings.parent.clone(), parents[key])
      @callback 'afterParentCreate', key
  if children != false
    for childKey of children
      for child of children[childKey]
        # key here is the *parent*
        @keys.children.remove child
        @keys.children.push child
        # attach it to a named ID instead
        @callback 'beforeChildCreate', child
        @attach @add(@settings.child.clone(), children[childKey][child]), childKey
        @callback 'afterChildCreate', child
  return

# attach an object to its container

Live::attach = (obj, id) ->
  if id
    # children go into div.children
    obj.appendTo $('#' + id + ' .children')
  else
    obj.prependTo $('.live-object[data-uri=\'' + @feed + '\']')
  return

# resolve a key

Live::resolve = (needle, haystack) ->
  # yay references
  self = this
  obj = undefined
  if needle.indexOf('global:') == 0
    needle = needle.replace('global:', '')
    tmp = self.find(needle, window)
    obj =
      key: needle
      value: if tmp then tmp else self.find(needle, document)
  else if needle.indexOf('object:') == 0
    needle = needle.replace('object:', '')
    obj =
      key: needle
      value: self.find(needle, @data)
  else
    obj =
      key: needle
      value: self.find(needle, haystack)
  obj

# private method for resolve. technically static.

Live::find = (needle, haystack) ->
  if needle.indexOf('.') >= 0
    keys = needle.split('.')
    i = 0
    while i < keys.length
      try
        haystack = haystack[keys[i]]
      catch e
        return null
      i++
    return haystack
  haystack[needle]

# replace attributes on an object

Live::replace = (obj, haystack) ->
  key = obj.attr('data-replace')
  match = @resolve(key, haystack)
  content = undefined
  destination = undefined
  target = obj.attr('data-target')
  # this allows "mock" attributes to avoid the browser doing stuff automatically.
  # example: src? <-> data-src to avoid browser pre-fetching and errors
  if target.slice(-1) == '?'
    destination = target.slice(0, -1)
    target = 'data-' + destination
    content = obj.attr(target)
    target = destination
  else
    content = obj.attr(target)
  if match
    if !obj.attr('data-template')
      obj.attr 'data-template', content
      obj.attr target, content.replace('{' + match.key + '}', match.value)
    else
      obj.attr target, obj.attr('data-template').replace('{' + match.key + '}', match.value)
  return

# add content to elements

Live::content = (obj, haystack) ->
  self = this
  obj.find('[data-content]').each ->
    content = self.resolve($(this).attr('data-content'), haystack).value
    if content
      $(this).html content
    return
  obj.find('[data-html]').each ->
    content = self.resolve($(this).attr('data-html'), haystack).value
    if content
      $(this).html content
    return
  obj.find('[data-text]').each ->
    content = self.resolve($(this).attr('data-text'), haystack).value
    if content
      $(this).text content
    return
  return

# apply changes (whether on  a fresh clone or an existing object)

Live::add = (obj, haystack) ->
  self = this
  obj.find('[data-replace]').each ->
    self.replace $(this), haystack
    return
  @content obj, haystack
  @attributes obj, haystack
  # assign IDs
  obj.attr 'id', haystack.id
  obj

# Add data-* attributes from comma-separated values

Live::attributes = (obj, haystack) ->
  attributes = obj.attr('data-attributes')
  if attributes
    attributes = attributes.split(',')
    i = 0
    while i < attributes.length
      attr = attributes[i]
      match = @resolve(attr, haystack)
      if match
        if match.value == null
          match.value = ''
        obj.attr 'data-' + match.key, match.value
      i++
  return

Live::callback = (callback, id) ->
  if @settings.callbacks[callback]
    @settings.callbacks[callback] @data, id
  return
