"use strict";

const domain = "https://jsonplaceholder.typicode.com/"

const getPhoto = id => {
    if (id < 1 || id > 5000) {
        return Promise.reject(
            new Error("Photo ID must be between 1 and 5000")
        );
    } else {
        return fetch (`${domain}/photos/${id}`)
            .then(response => response.json());
    }
};

const getPhotoAlbum = photo => {
    return fetch(`${domain}/albums/${photo.albumId}`)
        .then(response => response.json())
        .then(album => {
            photo.album = album;
            return photo;
        });
};

const getPhotoAlbumUser = photo => {
    return fetch(`${domain}/users/${photo.album.userId}`)
        .then(response => response.json())
        .then(user => {
            photo.album.user = user;
            return photo;
        });
};

const displayPhoto = photo => {
    let html = `<img src="${photo.thumbnailUrl}" alt="${photo.title}">`;
    html += `<h4>${photo.title}</h4>`;
    html += `<p>Album: ${photo.album.title}</p>`;
    html += `<p>Posted By: ${photo.album.user.username}</p>`;
    $("#display").html(html);
};

const displayError = err => {
    // $("#display").empty();
    let html = `<span>${err.message}</span>`;
    $("#display").html(html);
};

$(document).ready(() => {
    $("#view-button").click(() => {
        const id = $("#photo-id").val();
        getPhoto(id)
            .then(getPhotoAlbum)
            .then(getPhotoAlbumUser)
            .then(displayPhoto)
            .catch(displayError);
    });
});