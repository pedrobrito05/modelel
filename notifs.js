// Adiciona um evento de clique à aba de notificações
const dropdownMenu = document.querySelector('.dropdown-menu');
dropdownMenu.addEventListener('click', function() {
  // Adiciona a classe "notifications" com a animação "fade-in" à div com as notificações
  const notifications = document.querySelector('.notifications');
  notifications.classList.add('notifications');
});