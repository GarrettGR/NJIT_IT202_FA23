"use strict";

const displayUser = user => {
    let html = `<h4>${user.name}</h4>`;
    html += `<p>${user.email}</p>`;
    html += `<p>${user.age}</p>`;
    html += `<p>${user.city}</p>`;
    $("#display").html(html);
};

const displayError = err => {
    let html = `<span>${err.message}</span>`;
    $("#display").html(html);
};

const getUser = id => {
    if (id < 1 || id > 10) {
        return Promise.reject(
            new Error("User ID must be between 1 and 10")
        );
    } else {
        return fetch(`data.php?id=${id}`)
            .then(response => response.json());
    }
}

$(document).ready(() => {
    $("#view-button").click(() => {
        const id = $("#user-id").val();
        getUser(id)
            .then(displayUser)
            .catch(displayError);
    });
});