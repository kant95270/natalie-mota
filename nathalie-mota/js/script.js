// Gestion de la modale de contact
const modaleContent = document.querySelector('.modale-content');
const btnContact = document.querySelector('.myModal');
const btnModale = document.querySelector('.btnModal');
const modaleBox = document.querySelector('.modale-box');
const postCta = document.getElementById('js-post-cta');
// const refPhoto = document.getElementById('ref-photo');
// const formRefPhoto = document.getElementById('form-ref-photo');
const formRefPhoto = document.getElementById('form-ref-photo');
const btnContactMobile = document.getElementsByClassName('contactMobile');

// Fait apparaitre la modale au clic
// btnContact.addEventListener('click', openModale);
// btnModale.addEventListener('click', openModale);

if (btnContact) {
  btnContact.addEventListener('click', openModale);
  
}

if (btnModale) {
  btnModale.addEventListener('click', openModale);
}

// btnContactMobile.addEventListener('click', openModale);
if (postCta != null) {
  postCta.addEventListener('click', openModale);
}

// Gestion de la pagination des photos
(function ($) {
  $(document).ready(function () {
    // Gestion de la fermeture et de l'ouverture du menu
    // dans une modale pour la version mobile
    $('.btn-modal').click(function (e) {
      $('.modal__content').toggleClass('animate-modal');
      $('.modal__content').toggleClass('open');
      $('.btn-modal').toggleClass('close');
    });
    $('a').click(function () {
      if ($('.modal__content').hasClass('open')) {
        $('.modal__content').removeClass('animate-modal');
        $('.modal__content').removeClass('open');
        $('.btn-modal').removeClass('close');
      }
    });
    $('.contactMobile').click(function (e) {
      $('.modale-content').removeClass('modale-hide');
    });
  });
})(jQuery);

function openModale() {
  modaleContent.classList.remove('modale-hide');
  //Ajout de la rèf photo pour single post
  // Récupérer la référence de la photo depuis un attribut data sur le bouton qui a été cliqué
  // Supposons que le bouton a un attribut `data-photo-ref`
  let photoRef = this.getAttribute('data-photo-ref'); // `this` fait référence à l'élément qui a déclenché l'événement

  // Mettre à jour la valeur de la référence de la photo dans le champ du formulaire dans la modale
  // Assurez-vous que l'ID ou le nom du champ dans le formulaire correspond à 'form-ref-photo'
  if (formRefPhoto) {
    formRefPhoto.value = photoRef;
  }
}

// Fait disparaitre la modale au clic & echap
function closeModale() {
  modaleBox.classList.remove('modale-box-anim-in');
  modaleContent.classList.add('modale-anim-out');
  modaleBox.classList.add('modale-box-anim-out');
  window.setTimeout(function () {
    modaleContent.classList.add('modale-hide');
    modaleContent.classList.remove('modale-anim-out');
    modaleBox.classList.remove('modale-box-anim-out');
    modaleBox.classList.add('modale-box-anim-in');
  }, 500);
}

modaleContent.addEventListener('click', closeModale);


modaleBox.addEventListener('click', function (e) {
  e.stopPropagation();
});

window.addEventListener('keydown', function (e) {
  if (e.key === 'Escape' || e.key === 'Esc') {
    closeModale();
  }
});