const users = document.getElementById("users");

if (users) {
    users.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-user') {
            const id = e.target.getAttribute('data-id');
            fetch(`/user/${id}`, {
                method: 'DELETE'
            }).then(res => window.location.reload());
        }
    });
}
