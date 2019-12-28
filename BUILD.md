Build the project
=================

    symfony new inertia --full
    composer require symfony/apache-pack
    composer require symfony/webpack-encore-bundle
    composer require rompetomp/inertia-bundle

* (had to drop twig/twig to "2.12.*")
* copy config from dsv (doctrine, doctrine-migration, .env.local, .env.test.local)
* create the database
* add `.enableSassLoader()` and `.enableVueLoader()` to webpack.config.js

    yarn install
    yarn encore dev

Run `yarn` commands listed in the error from previous command, at this time:

    yarn add sass-loader@^7.0.1 node-sass --dev

then:

    yarn add vue vue-loader@^15.0.11 vue-template-compiler --dev

Install inertia and client adapter

    yarn add @inertiajs/inertia @inertiajs/inertia-vue

Configure inertia vue as per https://inertiajs.com/client-side-setup

Configure inertia-bundle as per https://github.com/rompetomp/inertia-bundle

* Set up the root template / delete the standard base.html.twig symfony template
* Set up the front end adapter (really just replace `enableSingleRuntimeChunk()` with `disableSingleRuntimeChunk()`, and a bit of a cleanup)
* create controller

F*** UP!
========

After trying to install test libraries (mink, panther, mink-panther-driver), it became clear that symfony 5.0 is not ready to fly (mink not working yet with 5.0), so rolled back to 4.4. But, i haven't updated the config yet with v4 config. Stuff seems to be working ok in dev, but if you get any weirdness with prod or test, copy config from dsv. Or (better) kick off a new project for 4.4 and copy shit over.

To Do?
======

Left out the following encore config from https://github.com/rompetomp/inertia-bundle:

    .addAliases({
        vue$: 'vue/dist/vue.runtime.esm.js',
        '@': path.resolve('assets/js')
    })

Load components script from dsv

Update config with v4 symfony config? See F*** UP above for more info.

Fixture Factory

Mocker? Never gonna work?

WebTestCase using Mink/Panther stuff