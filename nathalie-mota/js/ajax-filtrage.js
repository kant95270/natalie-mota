jQuery(document).ready(function ($) {
    $('.filter-categorie, .filter-formats, .filter-order').change(function () {
      let categorie = $('.filter-categorie').val();
      let formats = $('.filter-formats').val();
      let order = $('.filter-order').val(); // Récupérer la valeur de tri
  
      $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
          action: 'filtrer_photos',
          categorie: categorie,
          formats: formats,
          order: order, // Envoyer la valeur de tri
        },
        success: function (response) {
          $('.photo-grid').html(response);
        },
      });
    });
  });
  
  jQuery(document).ready(function ($) {
    let currentCategorie = $('.filter-categorie').val();
    let currentFormats = $('.filter-formats').val();
    let currentOrder = $('.filter-order').val();
  
    function loadMorePhotos(page) {
      $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
          action: 'filtrer_photos',
          categorie: currentCategorie,
          formats: currentFormats,
          order: currentOrder,
          page: page,
        },
        success: function (response) {
          if (page === 1) {
            $('.photo-grid').html(response);
          } else {
            $('.photo-grid').append(response);
          }
  
          if (
            $('#no-more-posts').length > 0 ||
            $(response).filter('.photo-item').length < 8
          ) {
            $('#load-more').hide();
          } else {
            $('#load-more').show().data('page', page);
          }
        },
      });
    }
  
    $('.filter-categorie, .filter-formats, .filter-order').change(function () {
      currentCategorie = $('.filter-categorie').val();
      currentFormats = $('.filter-formats').val();
      currentOrder = $('.filter-order').val();
  
      loadMorePhotos(1); // Réinitialiser et charger la première page
    });
  
    $('#load-more').click(function () {
      let page = $(this).data('page') + 1;
      loadMorePhotos(page);
    });
  });