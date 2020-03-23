var TCCR = {};

TCCR.App = function() {
    this.API_ENDPOINT = '/tccr/public/';

    this.index = null;

    this.apiURL = function(url) {
        return this.API_ENDPOINT + url;
    };

    this.init = function() {
        this.initIndex();
    };

    this.initIndex = function(data) {
        this.index = new FlexSearch({
            encode: "advanced",
            tokenize: "reverse",
            suggest: true,
            cache: true
        });

        if (!data) {
            return;
        }

        for (var i = 0; i < data.length; i++) {
            index.add(i, data[i]);
        }
    };

    this.initUI = function() {
        var suggestions = document.getElementById("suggestions");
        var autocomplete = document.getElementById("autocomplete");
        var userinput = document.getElementById("userinput");

        userinput.addEventListener("input", show_results, true);
        userinput.addEventListener("keyup", accept_autocomplete, true);
        suggestions.addEventListener("click", accept_suggestion, true);
    };

    this.show_results = function() {

        var value = this.value;
        var results = index.search(value, 25);
        var entry, childs = suggestions.childNodes;
        var i = 0,
            len = results.length;

        for (; i < len; i++) {

            entry = childs[i];

            if (!entry) {

                entry = document.createElement("div");
                suggestions.appendChild(entry);
            }

            entry.textContent = data[results[i]];
        }

        while (childs.length > len) {

            suggestions.removeChild(childs[i])
        }

        var first_result = data[results[0]];
        var match = first_result && first_result.toLowerCase().indexOf(value.toLowerCase());

        if (first_result && (match !== -1)) {

            autocomplete.value = value + first_result.substring(match + value.length);
            autocomplete.current = first_result;
        } else {

            autocomplete.value = autocomplete.current = value;
        }
    }

    this.accept_autocomplete = function(event) {
        if ((event || window.event).keyCode === 13) {

            this.value = autocomplete.value = autocomplete.current;
        }
    }

    this.accept_suggestion = function(event) {

        var target = (event || window.event).target;

        userinput.value = autocomplete.value = target.textContent;

        while (suggestions.lastChild) {

            suggestions.removeChild(suggestions.lastChild);
        }

        return false;
    }

    this.boot = function() {
        axios.get(this.apiURL('/info/users')).then(function(response) {
            console.log(response.data);
        });
    };
};

$(function() {
    var app = new TCCR.App();
    app.boot();
});