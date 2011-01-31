This add-on allows you to display a list of channel entries that have been recently viewed by the user. It is a two part add-on: an extension and a plugin.
You place the plugin in your single entry template, passing the entry id as such: 
{exp:jp_recently_viewed:setcookie entry_id="{entry_id}"} (obviously within your {exp:channel:entries} tag pair.)

Displaying recently viewed entries is as simple as using a standard channel:entries tag, adding the recently_viewed='y' parameter, like so:
{exp:channel:entries channel="doggies" limit="10" recently_viewed="y"}
<a href="{url_title}">{title}</a>
{/exp:channel:entries}
