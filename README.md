#k4-navigation Craft Plugin
Twig filter for advanced navigations in Craft CMS

- Install & Activate Plugin
- Create your navigation menu in craft template
- use the Twig filter to optimize


##Example for usage in craft template

First, set your Menu in craft.

        {% set mainnavigation %}
            {% cache globally for 3 years %}


        {% set entries = craft.entries.section('pages') %}

        <ul id="nav">
            {% nav entry in entries %}
                <li>
                    <a href="{{ entry.url }}">{{ entry.title }}</a>
                    {% ifchildren %}
                        <ul>
                            {% children %}
                        </ul>
                    {% endifchildren %}
                </li>
            {% endnav %}
        </ul>

        {% endcache %}
        {% endset %}

Now you can use extended twig filer like showed 

###Simple add class "active" to all Parent-Elements of selected item
            {{ mainnavigation | k4NavigationGetActivePath("test7.html") | raw}} 

###Simple Menu shows only first level and also selected path
        {{ mainnavigation | k4NavigationGetSimpleNavigation("test7.html") | raw}} 

###Show Breadcrumb for menu
        {{ mainnavigation | k4NavigationGetBreadcrumb(craft.request.getUrl()) | raw}} 
