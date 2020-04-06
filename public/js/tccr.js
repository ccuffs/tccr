var TCCR = {};

TCCR.Main = function() {
    var self = this;

    this.API_ENDPOINT = '/tccr/public/';

    this.modules = {};
    this.data = {}; // read by all modules

    this.api = function(url) {
        return this.API_ENDPOINT + url;
    };

    this.load = function(module, prop) {
        if(!prop) {
            throw Error('Invalid module name: ' + prop);
        }

        module.main = this;
        this.modules[prop] = module;
    };

    this.loadModules = function() {
        var id;
        var module;

        for(id in this.modules) {
            module = this.modules[id];

            if(!module.init) {
                continue;
            }

            module.init();
        }
    };

    this.boot = function() {
        this.loadModules();

        // Integrate Laravel's CSRF token into all axios calls.
        window.axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
    };
};

TCCR.app = new TCCR.Main();

$(function() {
    TCCR.app.boot();
});