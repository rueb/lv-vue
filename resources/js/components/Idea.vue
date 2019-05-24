<template>
    <div>
        <h2 class="text-center">Captura tus Ideas</h2>
                        <div class="well">
                            <h4>¿En que estas pensando?</h4>
                            <form v-on:submit.prevent="createIdea" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control input-sm" maxlenght="256" v-model="newIdea">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Agregar
                                        </button>
                                    </span>
                                </div>
                            </form>
                            <hr>
                            <ul class="list-unstyled">
                                <li v-for="idea in ideas">
                                    <p>
                                        <small class="text-muted">
                                            <em>{{ since(idea.created_at) }}</em>
                                        </small>
                                        {{ idea.decripcion }}
                                    </p>
                                </li>
                            </ul>
                        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import toastr from 'toastr';
    import moment from 'moment';

    moment.lang('es');

    export default {
      data ()  {
          return {
              ideas: [],
              newIdea: '',
          }
      },
      created: function(){
          this.getIdeas();
      },
      methods: {
        since: function(d){
            return moment(d).fromNow();
        },
        getIdeas: function()  {
            var urlIdeas= 'mis-ideas';
            axios.get(urlIdeas).then(response => {
                this.ideas=response.data
            });
        },
        createIdea: function(){
            var url = 'guardar-idea';
            axios.post(url, {
                descripcion: this.newIdea
            }).then(response => {
                this.getIdeas();
                this.newIdea = '';
                toastr.success('Nueva Idea registrada');
            }).catch(error => {
                toastr.error('Error');
            });
        }
      }
    }
</script>

