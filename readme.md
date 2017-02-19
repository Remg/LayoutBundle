## Installation

**1**  Add to composer.json to the `require` key

``` shell
    $composer require remg/layout-bundle
``` 

**2** Register the bundles in ``app/AppKernel.php``

``` php
    $bundles = array(
    	// ..

        // Assetic Bundle
        new Symfony\Bundle\AsseticBundle\AsseticBundle(),
        // Knp Menu Bundle
        new Knp\Bundle\MenuBundle\KnpMenuBundle(),
        // Knp Paginator Bundle
        new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
        // Lexik Form Filter Bundle
        new Lexik\Bundle\FormFilterBundle\LexikFormFilterBundle(),
        // Liip Imagine Bundle
        new Liip\ImagineBundle\LiipImagineBundle(),
        // Remg Layout Bundle
        new Remg\LayoutBundle\RemgLayoutBundle(),

        // ..
    );
```

**3** Install and dump assets

``` shell
    $php bin/console assets:install
    $php bin/console assetic:dump
``` 

**4** Use the layout in your views

``` twig
	{% extends 'RemgLayoutBundle:admin:base.html.twig' %}

	{% block meta_title -%}
	    Page title
	{%- endblock meta_title %}

	{% block body %}
	    Hello world!
	{% endblock body %}
``` 
