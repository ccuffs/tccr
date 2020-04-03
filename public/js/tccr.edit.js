TCCR.Edit = function() {
    this.autocompletes = {};

    this.removeUser = function(el) {
        var entryId = el.dataset.entryId;
        var entry = document.getElementById(entryId);
        entry.remove();
        // TODO: check if valid, notify endpoints
    };

    this.onAutoCompleteClicked = function(containerId, user, el) {
        var container = document.getElementById(containerId);
        var entry = document.createElement('div');
        var id = containerId + user.username;

        entry.innerHTML = 
            '<div class="row align-items-center" id="' + id + '">' + 
                '<div class="col-2">' + 
                    '<img alt="image" class="user-avatar rounded-circle" src="https://colorlib.com/polygon/sufee/images/admin.jpg">' + 
                '</div>' + 
                '<div class="col-9">' + 
                    '<p>' + 
                        user.name + ' <br/>' + 
                        '<small class="text-muted">' + user.username + '</small><br />' + 
                        '<span class="badge badge-danger">Não confirmado</span>' + 
                    '</p>' + 
                '</div>' + 
                '<div class="col-1">' + 
                    '<a href="javascript:void(0);" onclick="TCCR.app.modules.edit.removeUser(this)" data-entry-id="' + id + '">R</a>' + 
                '</div>' + 
            '</div>';

        container.prepend(entry);
    };
    
    this.getOrCreateAutoComplete = function(containerId, inputId, suggestionsContainerId) {
        var ac = this.autocompletes[containerId];

        if(ac) {
            return ac;
        }

        ac = new IDUFFS.AutoComplete();
        
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

        this.autocompletes[containerId] = ac;
        return ac;
    };

    this.createUserSelection = function(containerId, inputId, suggestionsContainerId) {
        var self = this;
        var ac = this.getOrCreateAutoComplete(containerId, inputId, suggestionsContainerId);

        ac.signals.clicked.add(function(user, el) {
            self.onAutoCompleteClicked(containerId, user, el);
        });  
    };

    this.init = function() {
        console.debug('TCC.Edit.init');
        this.createUserSelection('examiners', 'examiner', 'examiner-suggestions');
    };
};

TCCR.app.load(new TCCR.Edit(), 'edit');