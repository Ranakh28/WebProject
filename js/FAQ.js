document.addEventListener('DOMContentLoaded', () => {
    const faqQuestions = document.querySelectorAll('.faq-question');

    faqQuestions.forEach(button => {
        button.addEventListener('click', () => {
            const currentItem = button.parentElement;
            const isOpen = currentItem.classList.contains('active');

            // إغلاق كل الأسئلة المفتوحة
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });

            // فتح السؤال الذي تم الضغط عليه (إذا لم يكن مفتوحاً)
            if (!isOpen) {
                currentItem.classList.add('active');
            }
        });
    });
});