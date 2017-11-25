window.onload = function () {
    refresh();
    setInterval(refresh, 10000);
};

function refresh() {
    chat_refreshChat();
    projects_retrieveProjects()
}