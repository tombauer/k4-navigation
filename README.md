#k4-navigation Craft Plugin
Twig filter for advanced navigations in Craft CMS. Demonstration of possible Options: http://www.bahu.ch/craft/

Usage:
- Install & Activate Plugin
- Create your navigation menu in craft template
- use the Twig filter to optimize


##Example for usage in craft template

First, set your Menu in craft.

        {% set mainnavigation %}
            {% cache globally for 3 years %}
            {% set entries = craft.entries.section('pages') %}

            <ul>
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

Now you can use the k4-navigation twig filter. See the examples below.

###Simple add class "active" to all Parent-Elements of selected item
        {{ mainnavigation | k4NavigationGetActivePath(craft.request.getUrl()) | raw }} 

###Simple Menu shows only first level and also selected path
        {{ mainnavigation | k4NavigationGetSimpleNavigation(craft.request.getUrl()) | raw }} 

###Show Breadcrumb for menu
       {{ mainnavigation | k4NavigationGetBreadcrumb(craft.request.getUrl()," > ") | raw }} 