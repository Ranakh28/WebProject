<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Glowberry</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* التنسيقات الخاصة بالصفحة لضمان ظهور الـ Grid بشكل صحيح */
        .faq-container {
            padding: 60px 5%;
            max-width: 1200px;
            margin: 0 auto;
            min-height: 70vh;
        }

        .page-heading {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 50px;
            font-size: 2.5rem;
        }

        .faq-category-title {
            color: var(--primary-color);
            margin: 40px 0 20px 0;
            font-size: 1.4rem;
            border-left: 4px solid var(--accent-hover);
            padding-left: 15px;
            width: 100%;
        }

        /* نظام الشبكة لتوزيع الأسئلة عمودين بجانب بعض */
        .faq-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        /* تنسيق الكرت (يشبه كرت البحث) */
        .faq-item {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #f9f9f9;
            transition: 0.3s ease;
            overflow: hidden;
            height: fit-content;
        }

        .faq-item:hover {
            transform: translateY(-5px);
            border-color: var(--accent-hover);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .faq-question {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px;
            border: none;
            background: none;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            color: var(--primary-color);
            cursor: pointer;
            font-weight: 500;
            text-align: left;
        }

        .faq-question span {
            font-size: 1.2rem;
            color: var(--accent-hover);
            transition: 0.3s;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease-out;
            color: #666;
            font-size: 0.9rem;
            line-height: 1.6;
            padding: 0 25px;
            background-color: #fdfdfd;
        }

        /* الحالة النشطة عند فتح السؤال */
        .faq-item.active .faq-answer {
            max-height: 300px;
            padding: 10px 25px 25px 25px;
            border-top: 1px solid #f1f1f1;
        }

        .faq-item.active .faq-question span {
            transform: rotate(45deg);
            color: var(--primary-color);
        }

        /* دعم الجوال ليكون عمود واحد */
        @media (max-width: 768px) {
            .faq-grid {
                grid-template-columns: 1fr;
            }
            .page-heading {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

    <?php include 'header.php';?>

    <main class="faq-container">
        <h2 class="page-heading">Frequently Asked Questions</h2>
        
        <h3 class="faq-category-title">Shipping & Delivery</h3>
        <div class="faq-grid">
            <div class="faq-item">
                <button class="faq-question">How long does delivery take? <span>+</span></button>
                <div class="faq-answer">
                    <p>Delivery usually takes 3 to 5 business days.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">Do you offer international shipping? <span>+</span></button>
                <div class="faq-answer">
                    <p>Yes, we offer international shipping to various countries. You can view the full list during checkout.</p>
                </div>
            </div>
        </div>

        <h3 class="faq-category-title">Products & Beauty</h3>
        <div class="faq-grid">
            <div class="faq-item">
                <button class="faq-question">Are your products authentic? <span>+</span></button>
                <div class="faq-answer">
                    <p>At Glowberry Cosmetics, we guarantee that all our products are 100% authentic and sourced from authorized distributors.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">How do I choose the right foundation shade? <span>+</span></button>
                <div class="faq-answer">
                    <p>Don't worry! You can contact our customer service team via WhatsApp for a free consultation to find your perfect match.</p>
                </div>
            </div>
        </div>

        <h3 class="faq-category-title">Payment & Orders</h3>
        <div class="faq-grid">
            <div class="faq-item">
                <button class="faq-question">What are the available payment methods? <span>+</span></button>
                <div class="faq-answer">
                    <p>We support all secure payment methods, including Credit Cards (Visa, MasterCard), Mada, and Apple Pay.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">How can I track my order? <span>+</span></button>
                <div class="faq-answer">
                    <p>Once your order is shipped, we will send you an email with your tracking number and a direct link to track your package.</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const item = question.parentElement;
                item.classList.toggle('active');
            });
        });
    </script>

    <?php include 'footer.php';?>

</body>
</html>