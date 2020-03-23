var TCCR = {};

TCCR.App = function() {
    var self = this;

    this.API_ENDPOINT = '/tccr/public/';

    this.index = null;
    this.autocomplete = null;
    this.data = null;

    this.apiURL = function(url) {
        return this.API_ENDPOINT + url;
    };

    this.initIndex = function(data) {
        this.index = new FlexSearch({
            encode: 'advanced',
            tokenize: 'reverse',
            suggest: true,
            cache: true
        });

        if (!data) {
            console.warn('Index is empty.');
            return;
        }

        for (var i = 0; i < data.length; i++) {
            console.log(i, data[i]);
            this.index.add(i, data[i].name);
        }

        this.data = data;
    };

    this.indexSearch = function(term) {
        return self.index.search(term, 25);
    };

    this.indexInfo = function(key) {
        return self.data[key] ? self.data[key].name : null;
    }

    this.boot = function() {
        var self = this;

        axios.get(this.apiURL('/info/users')).then(function(response) {
            self.initIndex(response.data);
            self.autocomplete = new IDUFFS.AutoComplete();
            self.autocomplete.init(self.indexSearch, self.indexInfo, 'userinput', 'suggestions', 'autocomplete');
        });
    };
};

$(function() {
    var app = new TCCR.App();
    app.boot();
});