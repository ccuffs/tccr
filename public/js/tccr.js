var TCCR = {};

TCCR.Main = function() {
    var self = this;

    this.API_ENDPOINT = '/tccr/public/';

    this.modules = {};

    this.apiURL = function(url) {
        return this.API_ENDPOINT + url;
    };

    this.load = function(module, prop) {
        if(!prop) {
            throw Error('Invalid module name: ' + prop);
        }

        this.modules[prop] = module;
    };

    this.api = function(endpoint, callback) {
        axios.get(this.apiURL('/info/users')).then(function(response) {
            callback(response);
        });
    };

    this.boot = function() {
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
};

TCCR.app = new TCCR.Main();

$(function() {
    TCCR.app.boot();
});