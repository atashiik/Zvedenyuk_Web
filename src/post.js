document.addEventListener("DOMContentLoaded", async function () {
    const postContainer = document.getElementById("post-container");
    const commentsContainer = document.getElementById("comments-container");

    const urlParams = new URLSearchParams(window.location.search);
    const postId = urlParams.get("id");

    if (!postId) {
        postContainer.innerHTML = `<p style="color: red;">Ошибка: ID поста не найден</p>`;
        return;
    }

    try {
        const postResponse = await fetch(`https://jsonplaceholder.typicode.com/posts/${postId}`);
        if (!postResponse.ok) {
            throw new Error("Ошибка загрузки поста");
        }
        const post = await postResponse.json();

        postContainer.innerHTML = `
            <h1>${post.title}</h1>
            <p>${post.body}</p>
            <h2>Комментарии:</h2>
        `;

        const commentsResponse = await fetch(`https://jsonplaceholder.typicode.com/posts/${postId}/comments`);
        if (!commentsResponse.ok) {
            throw new Error("Ошибка загрузки комментариев");
        }
        const comments = await commentsResponse.json();

        commentsContainer.innerHTML = comments.map(comment => `
            <div class="comment">
                <strong>${comment.name}</strong> <em>(${comment.email})</em>
                <p>${comment.body}</p>
            </div>
        `).join("");

    } catch (error) {
        postContainer.innerHTML = `<p style="color: red;">Ошибка: ${error.message}</p>`;
    }
});
