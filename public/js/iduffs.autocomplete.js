var IDUFFS = IDUFFS || {};

IDUFFS.AutoComplete = function() {
    var self = this;

    this.searchFn = null;
    this.infoFn = null;

    this.showResults = function() {
        var value = this.value;
        var results = self.searchFn(value);
        var entry, childs = self.suggestions.childNodes;
        var i = 0,
            len = results.length;

        for (; i < len; i++) {

            entry = childs[i];

            if (!entry) {
                entry = document.createElement('div');
                self.suggestions.appendChild(entry);
            }

            entry.textContent = self.infoFn(results[i]);
        }

        while (childs.length > len) {
            self.suggestions.removeChild(childs[i])
        }

        var first_result = self.infoFn(results[0]);
        var match = first_result && first_result.toLowerCase().indexOf(value.toLowerCase());

        if (first_result && (match !== -1)) {
            self.autoComplete.value = value + first_result.substring(match + value.length);
            self.autoComplete.current = first_result;
        } else {
            self.autoComplete.value = self.autoComplete.current = value;
        }
    };

    this.acceptAutocomplete = function(event) {
        if ((event || window.event).keyCode === 13) {
            this.value = self.autoComplete.value = self.autoComplete.current;
        }
    };

    this.acceptSuggestion = function(event) {
        var target = (event || window.event).target;

        self.userInput.value = self.autoComplete.value = target.textContent;

        while (self.suggestions.lastChild) {
            self.suggestions.removeChild(self.suggestions.lastChild);
        }

        return false;
    };

    this.init = function(searchFn, infoFn, userInput, suggestions, autocomplete) {
        if (!searchFn) {
            console.error('Provided search function is invalid.');
            return;
        }

        this.searchFn = searchFn;
        this.infoFn = infoFn;

        this.suggestions = document.getElementById(suggestions);
        this.autoComplete = document.getElementById(autocomplete);
        this.userInput = document.getElementById(userInput);

        this.userInput.addEventListener('input', this.showResults, true);
        this.userInput.addEventListener('keyup', this.acceptAutocomplete, true);
        this.suggestions.addEventListener('click', this.acceptSuggestion, true);
    };
};