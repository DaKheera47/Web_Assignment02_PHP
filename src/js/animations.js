$(document).ready(function () {
    // Get all the elements you want to show on scroll
    const targets = document.querySelectorAll(".js-show-on-scroll");
    console.log("🚀 ~ file: animations.js:5 ~ targets:", targets);

    // Callback for IntersectionObserver
    const callback = function (entries) {
        entries.forEach((entry) => {
            // Is the element in the viewport?
            if (entry.isIntersecting) {
                // Add the fadeIn class:
                entry.target.classList.add("motion-safe:animate-fadeIn");
            } else {
                // Otherwise remove the fadein class
                entry.target.classList.remove("motion-safe:animate-fadeIn");
            }
        });
    };

    // Set up a new observer
    const observer = new IntersectionObserver(callback);

    // Loop through each of the target
    targets.forEach(function (target) {
        console.log(target);

        // Hide the element
        target.classList.add("opacity-0");

        // Add the element to the watcher
        observer.observe(target);
    });
});
