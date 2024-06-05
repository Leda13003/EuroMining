function toggleSubNav(event) {
    // Empêcher le lien par défaut de se déclencher
    event.preventDefault();
  
    // Sélectionner la sous-barre de navigation
    var subNav = document.querySelector('.subNav');
  
    // Basculer l'affichage de la sous-barre de navigation
    if (subNav.style.display === 'none') {
      subNav.style.display = 'block';
    } else {
      subNav.style.display = 'none';
    }
  }
  