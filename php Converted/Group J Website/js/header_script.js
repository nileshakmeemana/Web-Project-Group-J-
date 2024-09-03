document.querySelector('.profile-icon').addEventListener('click', function() {
    const dropdown = document.querySelector('.dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
});

document.addEventListener('click', function(event) {
    const userMenu = document.querySelector('.user-menu');
    const dropdown = document.querySelector('.dropdown');

    if (!userMenu.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});