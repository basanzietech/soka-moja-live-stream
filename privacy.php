<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Mpingo TV</title>
    <link rel="icon" href="favicon.svg" type="image/svg+xml" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1><span class="logo">M</span>Mpingo TV</h1>
        <button class="theme-toggle" id="theme-toggle" aria-label="Toggle theme">
            <span class="material-symbols-outlined icon-light">light_mode</span>
            <span class="material-symbols-outlined icon-dark">dark_mode</span>
            <span class="theme-label">Theme</span>
        </button>
    </header>
    <main class="legal-page">
        <h1>Privacy Policy for Mpingo TV</h1>
        <p><em>Last Updated: June 24, 2024</em></p>
        <p>Welcome to Mpingo TV. We are committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website. Please read this privacy policy carefully. If you do not agree with the terms of this privacy policy, please do not access the site.</p>
        <h2>1. COLLECTION OF YOUR INFORMATION</h2>
        <p>We may collect information about you in a variety of ways. The information we may collect on the Site includes:</p>
        <h3>Personal Data</h3>
        <p>Currently, we do not directly collect personally identifiable information, such as your name, shipping address, email address, and telephone number, when you visit the Site. You can browse our Site without providing any personal information. However, we may offer services in the future that require you to register or provide such information.</p>
        <h3>Derivative Data</h3>
        <p>Information our servers automatically collect when you access the Site, such as your IP address, your browser type, your operating system, your access times, and the pages you have viewed directly before and after accessing the Site. This information is used for the operation of the service, to maintain quality of the service, and to provide general statistics regarding use of the Mpingo TV website. As we are using a client-side script to fetch data, some of this information may be processed by third-party services we use.</p>
        <h3>Third-Party Data</h3>
        <p>Our website utilizes the Sofascore API to display sports match data. Sofascore may collect data as you interact with the content provided through their API. We do not control their data collection or privacy practices. We strongly advise you to review the Privacy Policy of Sofascore and any other third-party services to understand how they collect, use, and share your information. We are not responsible for the data practices of any third parties.</p>
        <h2>2. USE OF YOUR INFORMATION</h2>
        <p>Having accurate information about you permits us to provide you with a smooth, efficient, and customized experience. Specifically, we may use information collected about you via the Site to:</p>
        <ul>
            <li>Enhance the user experience and operation of the Site.</li>
            <li>Monitor and analyze usage and trends to improve your experience with the Site.</li>
            <li>Respond to your comments, questions, and provide customer service.</li>
            <li>Compile anonymous statistical data and analysis for use internally or with third parties.</li>
            <li>Prevent fraudulent transactions, monitor against theft, and protect against criminal activity.</li>
            <li>Troubleshoot problems and resolve disputes.</li>
        </ul>
        <p>We do not sell, distribute, or lease your personal information to third parties unless we have your permission or are required by law to do so.</p>
        <h2>3. DISCLOSURE OF YOUR INFORMATION</h2>
        <p>We may share information we have collected about you in certain situations. Your information may be disclosed as follows:</p>
        <h3>By Law or to Protect Rights</h3>
        <p>If we believe the release of information about you is necessary to respond to legal process, to investigate or remedy potential violations of our policies, or to protect the rights, property, and safety of others, we may share your information as permitted or required by any applicable law, rule, or regulation. This includes exchanging information with other entities for fraud protection and credit risk reduction.</p>
        <h3>Third-Party Service Providers</h3>
        <p>We may share your information with third parties that perform services for us or on our behalf, including data analysis, hosting services, and customer service. As of now, our primary third-party service provider is Sofascore for match data. Their API is integrated into our site, but we do not actively send your personal data to them.</p>
        <h2>4. TRACKING TECHNOLOGIES</h2>
        <h3>Cookies and Web Beacons</h3>
        <p>We may use cookies, web beacons, tracking pixels, and other tracking technologies on the Site to help customize the Site and improve your experience. When you access the Site, your personal information is not collected through the use of tracking technology. Most browsers are set to accept cookies by default. You can remove or reject cookies, but be aware that such action could affect the availability and functionality of the Site.</p>
        <h3>Local Storage</h3>
        <p>We use local storage to save your theme preference (light or dark mode). This information is stored on your device and is not transmitted to our servers. This helps ensure that your viewing preference is maintained across your sessions for a better user experience.</p>
        <h2>5. SECURITY OF YOUR INFORMATION</h2>
        <p>We use administrative, technical, and physical security measures to help protect your information. While we have taken reasonable steps to secure the information you provide to us, please be aware that despite our efforts, no security measures are perfect or impenetrable, and no method of data transmission can be guaranteed against any interception or other type of misuse. Any information disclosed online is vulnerable to interception and misuse by unauthorized parties. Therefore, we cannot guarantee complete security if you provide personal information.</p>
        <h2>6. POLICY FOR CHILDREN</h2>
        <p>We do not knowingly solicit information from or market to children under the age of 13. If you become aware of any data we have collected from children under age 13, please contact us using the contact information provided below. We will take steps to delete such information from our systems as soon as possible.</p>
        <h2>7. CHANGES TO THIS PRIVACY POLICY</h2>
        <p>We may update this Privacy Policy from time to time in order to reflect, for example, changes to our practices or for other operational, legal, or regulatory reasons. We will notify you of any changes by updating the "Last Updated" date of this Privacy Policy. You are encouraged to periodically review this Privacy Policy to stay informed of our updates. You will be deemed to have been made aware of, will be subject to, and will be deemed to have accepted the changes in any revised Privacy Policy by your continued use of the Site after the date such revised Privacy Policy is posted.</p>
        <h2>8. CONTACT US</h2>
        <p>If you have questions or comments about this Privacy Policy, please contact us at: <a href="mailto:afrohitsmedia@gmail.com">afrohitsmedia@gmail.com</a></p>
    </main>
    <footer>
        <a href="privacy.php">Privacy Policy</a>
        <a href="terms.php">Terms of Service</a>
    </footer>
    <script>
    // Theme switcher logic
    function applyTheme(theme) {
      if (theme === 'dark') {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    }
    function setTheme(theme) {
      localStorage.setItem('theme', theme);
      applyTheme(theme);
    }
    document.addEventListener('DOMContentLoaded', function() {
      const themeToggle = document.getElementById('theme-toggle');
      const savedTheme = localStorage.getItem('theme') || 'dark';
      applyTheme(savedTheme);
      themeToggle.addEventListener('click', function() {
        const isDark = document.documentElement.classList.contains('dark');
        setTheme(isDark ? 'light' : 'dark');
      });
    });
    </script>
</body>
</html> 