import CommentForm from './components/comments/CommentForm'
import CommentList from './components/comments/CommentList'
import Like from './components/Like'
import Vue from 'vue'

Vue.config.productionTip = false

window.Event = new Vue()

Vue.prototype.comments = window.comments;

new Vue({
  el: '#app',

  components: Vue.prototype.comments === 1 ? {CommentForm, CommentList, Like} : {
    'comment-form': () => {},
    'comment-list': () => {}
  },

  mounted() {
    $('[data-confirm]').on('click', (e) => {
      // $('#modal .modal-body.alert').html($(e.currentTarget).data('confirm'));
      // $('#confirm').attr('data-form-id', $(e.currentTarget).data('form-id'));
      // $('#modal').modal();
      return confirm($(e.currentTarget).data('confirm'))
    })
  }
})
