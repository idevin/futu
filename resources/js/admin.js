import './bootstrap'
import 'trumbowyg'
import 'bootstrap-autocomplete'
import 'bootstrap4-tagsinput/tagsinput'

$('.trumbowyg-form').trumbowyg({
  svgPath: '/js/ui/icons.svg',
  autogrow: true,
  semantic: true,
  imageWidthModalEdit: true,
  removeformatPasted: true,
  defaultLinkTarget: '_blank',
  tagsToRemove: ['script', 'link']
})

// Toggle the side navigation
$('#sidenavToggler').click(function (e) {
  e.preventDefault()
  $('body').toggleClass('sidenav-toggled')
})

// Configure tooltips for collapsed side navigation
$('.navbar-sidenav [data-toggle="tooltip"]').tooltip({
  template: '<div class="tooltip navbar-sidenav-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})

$('#confirm').on('click', function (e) {
  $('form[data-form-id=' + $(this).data('form-id') + ']').submit()
  return true
})

let $tags = $('.tags');

$tags.tagsinput();

$tags.on('beforeItemAdd', function (event) {

  let name = event.item;
  let locale = $(event.currentTarget).attr('data-locale');
  let postId = $(event.currentTarget).attr('data-taggable-id');
  let taggableType = $(event.currentTarget).attr('data-taggable-type');
  let data = {
    'data': {'name': name, 'locale': locale, 'taggable_type': taggableType, 'taggable_id': postId},
    'method': 'POST'
  };
  if (!event.options || !event.options.preventPost) {
    $.ajax(window.blog + '/' + window.locale + '/api/v1/tags', data, function (response) {
      if (response.failure) {
        $('.tags').tagsinput('remove', name, {preventPost: true});
      }
    });
  }
});

$tags.on('beforeItemRemove', function (event) {
  let tag = event.item;
  let locale = $(event.currentTarget).attr('data-locale');
  let postId = $(event.currentTarget).attr('data-taggable-id');
  let taggableType = $(event.currentTarget).attr('data-taggable-type');

  if (!event.options || !event.options.preventPost) {
    $.ajax(window.blog + '/' + window.locale + '/api/v1/tags/' + tag, {
      'data': {'tag': tag, 'locale': locale, 'taggableType': taggableType, 'taggableId': postId},
      'method': 'DELETE'
    }, function (response) {
      if (response.failure) {
        $('.tags').tagsinput('add', tag, {preventPost: true});
      }
    });
  }
});

$tags.autoComplete({
  resolver: 'custom',
  formatResult: function (item) {
    return {
      value: item.id,
      text: item.name,
    };
  },
  events: {
    search: function (q, callback) {
      $.ajax(
        window.blog + '/' + window.locale + '/api/v1/tags',
        {
          data: {'q': q}
        }
      ).done(function (res) {
        callback(res.data)
      });
    }
  }
});
