// Comments Functionality
class CommentsManager {
    constructor() {
        this.init();
    }

    init() {
        this.attachEventListeners();
    }

    attachEventListeners() {
        // Like button functionality
        document.querySelectorAll('.btn-like').forEach(btn => {
            btn.addEventListener('click', (e) => this.handleLike(e));
        });

        // Comment form submission
        const commentForm = document.getElementById('commentForm');
        if (commentForm) {
            commentForm.addEventListener('submit', (e) => this.handleCommentSubmit(e));
        }

        // Character counter for comment textarea
        const textarea = document.getElementById('commentContent');
        if (textarea) {
            this.setupCharacterCounter(textarea);
        }
    }

    handleLike(e) {
        e.preventDefault();
        const btn = e.currentTarget;
        const commentId = btn.dataset.commentId;
        const likeCount = btn.querySelector('.like-count');
        
        if (!commentId) return;

        // Check if already liked
        if (btn.classList.contains('liked')) {
            return;
        }

        // Send like request
        fetch(`/comments/${commentId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                btn.classList.add('liked');
                if (likeCount) {
                    likeCount.textContent = data.likes;
                }
                // Disable button after like
                btn.disabled = true;
                btn.style.opacity = '0.6';
            } else {
                alert(data.message || 'Có lỗi xảy ra!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra, vui lòng thử lại!');
        });
    }

    handleCommentSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const submitBtn = form.querySelector('.btn-submit');
        const originalText = submitBtn.textContent;

        // Disable submit button
        submitBtn.disabled = true;
        submitBtn.textContent = 'Đang gửi...';

        // Submit form normally
        form.submit();
    }

    setupCharacterCounter(textarea) {
        const maxLength = 1000;
        const counter = document.createElement('div');
        counter.className = 'text-muted small mt-1';
        counter.style.textAlign = 'right';
        
        function updateCounter() {
            const remaining = maxLength - textarea.value.length;
            counter.textContent = `${textarea.value.length}/${maxLength} ký tự`;
            
            if (remaining < 50) {
                counter.classList.add('text-danger');
                counter.classList.remove('text-muted');
            } else {
                counter.classList.remove('text-danger');
                counter.classList.add('text-muted');
            }
        }

        textarea.parentNode.appendChild(counter);
        textarea.addEventListener('input', updateCounter);
        updateCounter();
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new CommentsManager();
});
