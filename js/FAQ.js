document.addEventListener('DOMContentLoaded', () => {
    const faqButtons = document.querySelectorAll('.faq-question');

    // التأكد من وجود أسئلة في الصفحة قبل التنفيذ
    if (faqButtons.length > 0) {
        faqButtons.forEach(button => {
            button.addEventListener('click', () => {
                const clickedItem = button.parentElement;
                const isActive = clickedItem.classList.contains('active');

                // 1. إغلاق جميع العناصر الأخرى
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });

                // 2. فتح العنصر المختار فقط إذا لم يكن مفتوحاً
                if (!isActive) {
                    clickedItem.classList.add('active');
                }
            });
        });
    }
});