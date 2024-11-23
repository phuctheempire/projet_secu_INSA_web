
function show_button() {
const content = document.getElementById('content');
const submit_cmt = document.getElementById('submit_cmt');

// Show submit button only when there's content in the input
content.addEventListener('input', function() {
    if (content.value.trim()) {
        submit_cmt.style.display = 'inline-block'; // Show button
    } else {
        submit_cmt.style.display = 'none'; // Hide button
    }
});
}