TCCR.Edit = function() {
    var self = this;

    this.API_ENDPOINT = '/tccr/public/';

    this.index = null;
    this.autocomplete = null;
    this.data = null;

    this.apiURL = function(url) {
        return this.API_ENDPOINT + url;
    };

    this.enhancePage = function() {
        var ac = new IDUFFS.AutoComplete();
        
        ac.init({
            group: 'computacao.ch',
            maxSuggestions: 30,
            suggestionsContainerId: 'suggestions',
            inputId: 'userinput',

        }).done(function(data) {
            console.log('Autocomplete está pronto. Elementos no indice: ' + data.length);

        }).fail(function(error) {
            console.log('Falha ao inicializar autocomplete: ', error);
        });

        ac.signals.clicked.add(function(entry, el) { console.log('clicked: ', entry, el); });
        ac.signals.hovered.add(function(entry, el) { console.log('hovered: ', entry, el); });
        ac.signals.added.add(function(entry, el) { console.log('added: ', entry, el); });
        ac.signals.removed.add(function(entry, el) { console.log('removed: ', entry, el); });
        ac.signals.fetched.add(function(keys) { console.log('fetched: ', keys); });
        ac.signals.hinted.add(function(value, entry) { console.log('hinted: ', value, entry); });
    };

    this.init = function() {
        console.debug('TCC.Edit.init');
    };
};

TCCR.app.load(new TCCR.Edit(), 'edit');