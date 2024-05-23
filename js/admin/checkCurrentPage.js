var links = document.querySelectorAll(".header__nav a");
var currentURL = window.location.href;
for (var i = 0; i < links.length; i++) {
    if (links[i].href === currentURL) {
        links[i].classList.add("current-page");
    } else if (currentURL.includes("?controller=admin&action=account&page=")) {
        links[2].classList.add("current-page");
    } else if (currentURL.includes("?controller=admin&action=category&page=")) {
        links[3].classList.add("current-page");
    } else if (currentURL.includes("?controller=admin&action=book&page=")) {
        links[4].classList.add("current-page");
    } else if (currentURL.includes("?controller=admin&action=borrow&page=")) {
        links[5].classList.add("current-page");
    } else if (currentURL.includes("?controller=admin&action=fine&page=")) {
        links[6].classList.add("current-page");
    } else if (currentURL.includes("?controller=admin&action=upload&page=")) {
        links[7].classList.add("current-page");
    } else if (
        currentURL.includes("?controller=admin&action=librarian&page=")
    ) {
        links[8].classList.add("current-page");
    }
}
