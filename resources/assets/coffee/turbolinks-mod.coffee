###
Copyright 2012-2014 David Heinemeier Hansson
Copyright 2015 ppy Pty. Ltd.

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
###

# TODO: use Turbolinks.replace instead when it's released.
@osu.replacePage = (html) ->
  $(document).trigger 'page:before-unload'
  # getting contents of body, copied off turbolinks.
  newDoc = document.documentElement.cloneNode()
  newDoc.innerHTML = html
  newDoc.body = newDoc.querySelector('body')
  document.documentElement.replaceChild newDoc.body, document.body

  # taken from turbolinks
  for script in document.body.querySelectorAll 'script[data-turbolinks-eval="always"]'
    copy = document.createElement 'script'
    copy.setAttribute attr.name, attr.value for attr in script.attributes
    copy.async = false unless script.hasAttribute 'async'
    copy.appendChild document.createTextNode script.innerHTML
    { parentNode, nextSibling } = script
    parentNode.removeChild script
    parentNode.insertBefore copy, nextSibling

  $(document).trigger 'page:load'
