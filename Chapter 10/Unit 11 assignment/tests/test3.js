const getPhoto = id => {
    if (id < 1 || id > 5000) {
        return Promise.reject(
            new Error("Photo ID must be between 1 and 5000")
        );
    } else {
        const domain = "https://jsonplaceholder.typicode.com/"
        const request = `${domain}/photos/${id}`;
        return fetch(request)
            .then(response => response.json());
    }
};

const displayPhoto = photo => {
    let html = `<img src="${photo.thumbnailUrl}" alt="${photo.title}">`;
    html += `<h4>${photo.title}</h4>`;
    $("#display").html(html);
};

const displayError = err => {
    // $("#display").empty();
    let html = `<span>${err.message}</span>`;
    $("#display").html(html);
};

$(document).ready(() => {

    let breadID = $("#breadID").val();

    getPhoto(breadID)
        .then(displayPhoto)
        .catch(displayError);

});