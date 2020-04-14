<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{% block pageTitle %}Learning Phalcon{% endblock %}</title>
    {{ stylesheetLink('css/bootstrap.min.css') }}
</head>

<body>
    {% block body %}
    <h1>Main layout</h1>
    {% endblock %}
    {{ javascriptInclude("js/jquery.min.js") }}
    {{ javascriptInclude("js/bootstrap.min.js") }}
    {% block javascripts %} {% endblock %}
</body>

</html>