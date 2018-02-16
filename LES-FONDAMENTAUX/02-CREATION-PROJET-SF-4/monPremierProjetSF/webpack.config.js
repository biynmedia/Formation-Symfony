var Encore = require('@symfony/webpack-encore');

Encore

    // Le répertoire dans lequel nos assets compilé seront enregistré.
    .setOutputPath('public/build/')

    // Chemin public utilisé par le serveur pour accéder au répertoire.
    .setPublicPath('/build')

    // Vide le répertoire Output avant chaque Build. (Regénération des fichiers)
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())

    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // Déclaration du fichier JS
    .addEntry('app', './assets/app.js')

    // Déclaration du fichier CSS
    // .addStyleEntry('css/app', './assets/app.scss')

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()

;

module.exports = Encore.getWebpackConfig();
