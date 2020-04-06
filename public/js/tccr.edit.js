TCCR.Edit = function() {
    this.autocompletes = {};

    this.removeUser = function(el) {
        var entryId = el.dataset.entryId;
        var entry = document.getElementById(entryId);
        entry.remove();
        // TODO: check if valid, notify endpoints

        axios.delete(this.main.api('participation/1'));
    };

    this.onAutoCompleteClicked = function(containerId, user, el) {
        var pageData = this.main.data.edit;
        
        var data = {
            user_id: pageData.user.id,
            project_id: pageData.project.id,
            role: 4
        };

        // TODO: needless to say this requires a major re-factoring =*
        axios.post(this.main.api('participation/add'), data, {headers: {'Accept': 'application/json'}})
            .then(function(response) {
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
                console.log(response);
            })
            .catch(function(error) {
                // Handle error (https://stackoverflow.com/a/55079885/29827)
                if (error.response) {
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.log(error.response.data.message);
                    console.log(error.response.data.errors);
                    // console.log(error.response.status);
                    // console.log(error.response.headers);
                } else if (error.request) {
                    // The request was made but no response was received
                    // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                    // http.ClientRequest in node.js
                    console.log(error.request);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
                console.log(error.config);
            });
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
        console.debug('TCC.Edit.init', this.main.data.edit);
        this.createUserSelection('examiners', 'examiner', 'examiner-suggestions');
    };
};

TCCR.app.load(new TCCR.Edit(), 'edit');