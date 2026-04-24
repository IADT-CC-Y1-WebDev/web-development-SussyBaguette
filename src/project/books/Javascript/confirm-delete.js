function confirmDelete(event) {
    const confirmed = confirm("Are you sure you want to delete this book?");
    
    if (!confirmed) {
        event.preventDefault(); // Stop navigation
    }
}