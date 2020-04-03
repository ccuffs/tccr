TCCR.Edit = function() {
    var self = this;

    this.API_ENDPOINT = '/tccr/public/';

    this.index = null;
    this.autocomplete = null;
    this.data = null;

    this.apiURL = function(url) {
        return this.API_ENDPOINT + url;
    };

    this.createUserSelection = function(containerId, inputId, suggestionsContainerId) {
        var ac = new IDUFFS.AutoComplete();
        
        ac.init({
            group: 'computacao.ch',
            maxSuggestions: 30,
            suggestionsContainerId: suggestionsContainerId,
            inputId: inputId,

        }).done(function(data) {
            console.log('Autocomplete está pronto. Elementos no indice: ' + data.length);

        }).fail(function(error) {
            console.log('Falha ao inicializar autocomplete: ', error);
        });

        ac.signals.clicked.add(function(user, el) {
            var container = document.getElementById(containerId);
            var entry = document.createElement('div');

            entry.innerHTML = 
                '<div class="row align-items-center ' + inputId +'-entry">' + 
                    '<div class="col-2">' + 
                        '<img alt="image" class="user-avatar rounded-circle" src="https://colorlib.com/polygon/sufee/images/admin.jpg">' + 
                    '</div>' + 
                    '<div class="col-10">' + 
                        '<p>' + 
                            user.name + ' <br/>' + 
                            '<small class="text-muted">' + user.username + '</small><br />' + 
                            '<span class="badge badge-danger">Não confirmado</span>' + 
                        '</p>' + 
                    '</div>' + 
                '</div>';

            container.prepend(entry);
        });
    };

    this.init = function() {
        console.debug('TCC.Edit.init');
        this.createUserSelection('examiners', 'examiner', 'examiner-suggestions');
    };
};

TCCR.app.load(new TCCR.Edit(), 'edit');