## JsRender: best-of-breed templating
*Simple and intuitive, powerful and extensible, lightning fast*<br/>
*For templated content in the browser or on Node.js (with Express 4, Hapi and Browserify integration)*<br/>

**JsRender** is a light-weight but powerful templating engine, highly extensible, and optimized for high-performance rendering, without DOM dependency. It is designed for use in the browser or on Node.js, with or without jQuery.

**JsRender** and **JsViews** together provide the next-generation implementation of the official jQuery plugins *JQuery Templates*, and *JQuery Data Link* - and supersede those libraries.

<h3>Documentation and Downloads</h3>
**[Documentation](http://www.jsviews.com)**, **[downloads](http://www.jsviews.com/#download)**, **[samples](http://www.jsviews.com/#samples)** and **[API docs and tutorials](http://www.jsviews.com/#jsrapi)** are available on the **[www.jsviews.com website](http://www.jsviews.com/#jsrender)**.


<h3>JsRender and JsViews</h3>
JsRender is used for data-driven rendering of templates to strings, ready for insertion in the DOM.<br/>
It is also used by the [JsViews](http://www.jsviews.com/#jsviews) platform, which adds data binding to JsRender templates,
and provides a fully-fledged MVVM platform for easily creating interactive data-driven single page apps and websites.

<h3>Installation</h3>

 jsrender.js is available from [downloads](http://www.jsviews.com/#download)  on the jsviews.com site. 

Alternatively:
- It can be installed with ***[Bower](http://bower.io/search/?q=jsrender)***, using `$ bower install jsrender` 
- It can be loaded using an AMD script loader, such as RequireJS
- On Node.js, after installing using  `$ npm install jsrender --save` it can be loaded for server-side rendering (or in the browser using Browserify ) using `var $ = require('jsrender');` *(see Node.js Integration topic below).*  

<h2>Usage</h2>

<h4><b>jQuery integration</b></h4>
When jQuery is present, JsRender loads as a jQuery plugin and adds `$.views`, `$.templates` and `$.render` to the jQuery namespace object, `$` (or `window.jQuery`).

<h4><b>JsRender without jQuery / on Node.js</b></h4>

When jQuery is not present, JsRender provides its own `jsrender` namespace, exposed as `window.jsrender`, or (on Node.js or with AMD loaders) returned by `require('jsrender')`. 

The `jsrender` namepace provides the same methods/APIs as with jQuery, so if jQuery is not present you can still use all the API examples, by simply writing:

```js
// In browser
var $ = window.jsrender;

// On Node.js (and similarly with AMD)
var $ = require('jsrender');

// Now use $.views... $.templates... $.render...
```

<h3><i>Define a template</i></h3>

From a string:

```js
var tmpl = $.templates("Name: {{:name}}");
```

From a template declared as markup in a script block:

```html
<script id="myTemplate" type="text/x-jsrender">
Name: {{:name}}
</script>
```
```js
var tmpl = $.templates("#myTemplate");
```

On Node.js, from an .html file containing the template markup:

```js
var $ = require('jsrender'); // returns the jsrender namespace object
var tmpl = $.templates("./myTemplate.html");
```
<a href="http://www.jsviews.com/#d.templates">Learn more...</a>

<h3><i>Render a template</i></h3>

`tmpl(object)` or `tmpl.render(object)` renders the template with the object as data context.

`tmpl(array)` or `tmpl.render(array)` renders the template once for each item in the array.

```js
var tmpl = $.templates(" Name: {{:name}}<br/> ");
```

```js
var person = {name: "Jim"};

// Render template for person object
var html = tmpl(person); // ready for insertion, e.g $("#container").html(html);

// result: "Name: Jim<br/> "
```

```js
var people = [{name: "Jim"}, {name: "Pedro"}];

// Render template for people array
var html = tmpl(people); // ready for insertion...

// result: "Name: Jim<br/> Name: Pedro<br/> "
```
<a href="http://www.jsviews.com/#rendertmpl">Learn more...</a>

<h3><i>Register a named template - and render it</i></h3>

```js
// Register named template - "myTmpl1
$.templates("myTmpl1", "Name: {{:name}}<br/> ");

var person = {name: "Jim"};

// Render named template
var html = $.templates.myTmpl1(person);

// Alternative syntax: var html = $.render.myTmpl1(person);

// result: "Name: Jim<br/> "
```
<a href="http://www.jsviews.com/#rendertmpl">Learn more...</a>

<h3><i>Template tags</i></h3>

<h4><b>Evaluation tags</b></h4>
<h4><i><b>{{: ...}}</b></i> (Evaluate)</h4>

`{{: pathOrExpr}}` inserts the value of the path or expression.

```js
var data = {address: {street: "Main Street"} };
var tmpl = $.templates("<b>Street:</b> {{:address.street}}");
var html =  tmpl(data);

// result: "<b>Street:</b> Main Street"
```

<a href="http://www.jsviews.com/#assigntag">Learn more...</a>

<h4><i><b>{{> ...}}</b></i> (HTML-encode)</h4> 

`{{> pathOrExpr}}` inserts the *HTML-encoded* value of the path or expression.

```js
var data = {condition: "a < b"};
var tmpl = $.templates("<b>Formula:</b> {{>condition}}");
var html =  tmpl(data);

// result: "<b>Formula:</b> a &lt; b"
```
<a href="http://www.jsviews.com/#htmltag">Learn more...</a>

<h4><b>Block tags</b></h4>

- Block tags can have content, unless they use the self-closing syntax:

 &dash; *Block tag - with content:* `{{someTag ...}} content {{/someTag}}`<br/>&dash; *Self-closing tag - no content (empty):* `{{someTag .../}}`

- A particular case of self-closing syntax is when any block tag uses the named parameter `tmpl=...`  to reference an external template, which then replaces what would have been the block content:
 
 &dash; *Self-closing block  tag referencing an external template:* `{{someTag ... tmpl=.../}}`<br/> (See [example](http://www.jsviews.com/#samples/jsr/composition/tmpl))

- All tags other than `{{: ...}}` `{{> ...}}` `{{* ...}}` `{{!-- --}}` behave as block tags

- Tags can take both unnamed arguments and named parameters:
 
 &dash; `{{someTag argument1 param1=...}} content {{/someTag}}`<br/>&dash; an example of a named parameter is the `tmpl=...`  parameter mentioned above<br/>&dash; arguments and named parameters can be assigned values from simple data-paths such as `address.street` or from richer expressions such as `product.quantity * 3.1 / 4.5`, or `name.toUpperCase()`

<h4><b>Built-in tags</b></h4>

<h4><i><b>{{include ...}}</b></i> (Template composition - partials)</h4> 

`{{include pathOrExpr}}...{{/include}}`evaluates the block content against a specified/modified data context.

`{{include ... tmpl=.../}}` evaluates the specified template against an (optionally modified) context, and inserts the result. (Template composition).

```js
var data = {name: "Jim", address: {street: "Main Street"} };

// Register two named templates
$.templates({
    streetTmpl: "<i>{{:street}}</i>",
    addressTmpl: "{{:name}}'s address is {{include address tmpl='streetTmpl'/}}."
});

// Render outer template
var html =  $.templates.addressTmpl(data);

// result: "Jim's address is <i>Main Street</i>"
```
<a href="http://www.jsviews.com/#includetag">Learn more...</a>

<h4><i><b>{{for ...}}</b></i> (Template composition, with iteration over arrays)</h4> 

`{{for pathOrExpr}}...{{/for}}`evaluates the block content against a specified data context. If the new data context is an array, it iterates over the array, renders the block content with each data item as context, and concatenates the result.

`{{for pathOrExpr tmpl=.../}}` evaluates the specified template against a data context. If the new data context is an array, it iterates over the array, renders the template with each data item as context, and concatenates the result.

```html
<script id="peopleTmpl" type="text/x-jsrender">
  <ul>{{for people}}
    <li>Name: {{:name}}</li>
  {{/for}}</ul>
</script>
```

```js
var data = {people: [{name: "Jim"}, {name: "Pedro"}] };
var tmpl = $.templates("#peopleTmpl");
var html =  tmpl(data);

// result: "<ul> <li>Name: Jim</li> <li>Name: Pedro</li> </ul>"
```
<a href="http://www.jsviews.com/#fortag">Learn more...</a>

<h4><i><b>{{props ...}}</b></i> (Iteration over properties of an object)</h4> 

`{{props pathOrExpr}}...{{/prop}}` or `{{props pathOrExpr tmpl=.../}}` iterates over the properties of the object returned by the path or expression, and renders the content/template once for each property - using as data context: `{key: propertyName, prop: propertyValue}`.

```html
<script id="personTmpl" type="text/x-jsrender">
  <ul>{{props person}}
    <li>{{:key}}: {{:prop}}</li>
  {{/props}}</ul>
</script>
```

```js
var data = {person: {first: "Jim", last: "Varsov"} };
var tmpl = $.templates("#personTmpl");
var html =  tmpl(data);

// result: "<ul> <li>first: Jim</li> <li>last: Varsov</li> </ul>"
```
<a href="http://www.jsviews.com/#propstag">Learn more...</a>

<h4><i><b>{{if ...}}</b></i> (Conditional inclusion)</h4> 

`{{if pathOrExpr}}...{{/if}}` or `{{if pathOrExpr tmpl=.../}}` renders the content/template only if the evaluated path or expression is 'truthy'.

`{{if pathOrExpr}}...{{else pathOrExpr2}}...{{else}}...{{/if}}`  behaves as '*if' - 'else if' - 'else'* and renders each block based on the condidtions.

```html
<script id="personTmpl" type="text/x-jsrender">
  {{if nickname}}
    Nickname: {{:nickname}}
  {{else name}}
    Name: {{:name}}
  {{else}}
    No name provided
  {{/if}}
</script>
```

```js
var data = {nickname: "Jim", name: "James"};
var tmpl = $.templates("#personTmpl");
var html =  tmpl(data);

// result: "Nickname: Jim"
```
<a href="http://www.jsviews.com/#iftag">Learn more...</a>

<h4><b>Other built-in tags</b></h4>

For details on all the above built-in tags, as well as *<a href="http://www.jsviews.com/#commenttag">comment tags</a>* <i><b>{{!-- ... --}}</b></i> and *<a href="http://www.jsviews.com/#allowcodetag">allow code tags</a>*  <i><b>{{\*&nbsp;...&nbsp;}} and {{\*:&nbsp;...}}</b></i>, see the [tags documentation](http://www.jsviews.com/#jsrtags) on jsviews.com.

<h4><b>Custom tags</b></h4>

Creating your own custom tags is easy. You can provide an object, with render method, template, event handlers, etc. See samples [here](http://www.jsviews.com/#samples/jsr/tags) and [here](http://www.jsviews.com/#samples/tag-controls) on jsviews.com. But for simple tags, you may only need a simple render function, or a template string. 

For example the two following definitions for a `{{fullName/}}` tag provide equivalent behavior:

As a render function:

```js
$.views.tags("fullName", function(val) {
    return val.first + " " + val.last;
});
```
Or as a template string:

```js
$.views.tags("fullName", "{{:first}} {{:last}}");
```

Either way, the result will be as follows:

```js
var tmpl = $.templates("{{fullName person/}}");
var data = {person: {first: "Jim", last: "Varsov"}};
var html =  tmpl(data);

// result: "Jim Varsov"
```

<h3><i>Helpers</i></h3>

For details on helpers, see the [Helpers](http://www.jsviews.com/#helpers) documentation topic on jsviews.com.

Here is a simple example.  Two helpers - a function, and a string:

```js
var myHelpers = {
    upper: function(val) { return val.toUpperCase(); },
    title: "Sir"
};
```

Access the helpers using the `~myhelper` syntax:

```js
var tmpl = $.templates("{{:~title}} {{:first}} {{:~upper(last)}}");
```

We can pass the helpers in with the `render()` method

```js
var data = {first: "Jim", last: "Varsov"};

var html =  tmpl(data, myHelpers);

// result: "Sir Jim VARSOV"
```

Or we can register helpers globally:

```js
$.views.helpers(myHelpers);

var data = {first: "Jim", last: "Varsov"};
var html =  tmpl(data);

// result: "Sir Jim VARSOV"
```
<a href="http://www.jsviews.com/#helpers">Learn more...</a>

<h3><i>Converters</i></h3>

Converters are used with the `{{:...}}` tag, using the syntax `{{mycvtr: ...}}}`.

Example - an *upper* converter, to convert to upper case: 

```js
$.views.converters("upper", function(val) { return val.toUpperCase(); });

var tmpl = $.templates("{{:first}} {{upper:last}}");
var data = {first: "Jim", last: "Varsov"};
var html =  tmpl(data);

// result: "Jim VARSOV"
```
<a href="http://www.jsviews.com/#converters">Learn more...</a>

<h3><i>Logic and expressions</i></h3>

JsRender supports rich expressions and logic, but at the same time encapsulates templates to prevent random access to globals. If you want to provide access to global variables within a template, you have to pass them in as data or as helpers.

You can assign rich expressions to any template arguments or parameters, as in:

`{{:person.nickname ? "Nickname: " + person.nickname : "(has no nickname)"}}`

or

```html
{{if ~limits.maxVal > (product.price*100 - discount)/rate}}
  ...
{{else ~limits.minVal < product.price}}
  ... 
{{else}}
  ... 
{{/if}}
```

<h3><i>Node.js Integration</i></h3>

On Node.js *JsRender* provides built-in ***Express***, ***Hapi*** and ***Browserify*** integration. This makes it easy to register templates as simple `.html` files on the file system, and then load and render them either server-side, client-side or both.

To learn more, see the [JsRender Node Starter](https://github.com/BorisMoore/jsrender-node-starter) project. 

<h3><i>Demos</i></h3>
Demos and samples can be found at [www.jsviews.com/#samples](http://www.jsviews.com/#samples), and throughout the [API documentation](http://www.jsviews.com/#jsrapi).

(See also the [demos](https://github.com/BorisMoore/jsrender/tree/master/demos) folder of this GitHub repository - available [here](http://borismoore.github.io/jsrender/demos/index.html) as live samples).
