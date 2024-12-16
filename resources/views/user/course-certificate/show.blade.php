<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sertifikat Penyelesaian</title>
    <style>
        @import "/resources/css/fonts.css";

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "Gabarito", sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 800px;
            margin: 20px;
            background: linear-gradient(115deg, #FDFDFD 0%, rgba(253, 253, 253, 0.85) 56.1%, #FDFDFD 100%);
            padding: 20px;
            border-radius: 14px;
            position: relative;
        }
        .container::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background: linear-gradient(90deg, #275380 0%, #4696E6 100%);
            z-index: -1;
            border-radius: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .header td {
            padding: 10px;
            vertical-align: middle;
        }
        .badge {
            color: #167ee6;
            font-size: 21px;
            text-align: right;
            font-weight: 700;
        }
        .content {
            margin-top: 60px;
        }
        .content h1 {
            font-size: 48px;
            margin: 0;
            color: #167ee6;
            font-weight: 700;
        }
        .content p {
            color: #696B6C;
        }
        .decorative {
            margin-left: auto;
            text-align: right;
        }
        .content1 {
            font-size: 28px;
        }
        .content2,
        .content b {
            font-size: 21px;
        }
        .content b{
            font-weight: bold;
        }
        .sertif {
            display: inline;
        }
        .footer {
            text-align: center;
        }
        .footer p {
            color: #494C4D;
            font-size: 16px;
            font-weight: 600;
        }
    </style>
  </head>
  <body>
        <div class="container">
            <!-- Header -->
            <table class="header">
                <tr>
                    <td class="logo">
                        <svg
                            width="100"
                            height="80"
                            viewBox="0 0 120 80"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M8.8125 65.5125C8.8125 56.0625 8.8125 72.1716 8.8125 51.3375C8.8125 41.8875 13.5375 37.1624 22.9875 37.1624C22.9875 37.1624 22.9875 37.1624 32.4375 37.1624C41.8875 37.1624 51.3375 32.4375 51.3375 22.9875C51.3375 13.5375 41.8875 8.8125 32.4375 8.8125C22.9875 8.8125 8.8125 8.8125 8.8125 8.8125"
                                stroke="#4696E6"
                                stroke-width="9.45"
                                stroke-linecap="round"
                            />
                            <path
                                d="M25.8605 68.4538C24.5249 68.4538 23.3405 68.2018 22.3073 67.6978C21.2993 67.1686 20.5181 66.4378 19.9637 65.5054C19.4093 64.573 19.1321 63.4894 19.1321 62.2546C19.1321 60.9442 19.4345 59.8354 20.0393 58.9282C20.6441 57.9958 21.4505 57.2776 22.4585 56.7736C23.4917 56.2696 24.6383 56.0176 25.8983 56.0176C27.7379 56.0176 29.2247 56.4334 30.3587 57.265C31.4927 58.0966 32.2487 59.2936 32.6267 60.856L30.2453 60.4402V56.131C30.2453 55.4506 30.0059 54.8584 29.5271 54.3544C29.0483 53.8504 28.2797 53.5984 27.2213 53.5984C26.5409 53.5984 25.7597 53.6866 24.8777 53.863C23.9957 54.0142 23.0885 54.3166 22.1561 54.7702L20.5307 50.839C21.6395 50.2846 22.8239 49.8436 24.0839 49.516C25.3691 49.1884 26.6795 49.0246 28.0151 49.0246C29.7287 49.0246 31.1651 49.327 32.3243 49.9318C33.4835 50.5366 34.3403 51.3934 34.8947 52.5022C35.4743 53.611 35.7641 54.8962 35.7641 56.3578V67.9624H31.2659L30.1697 64.3714L32.6267 63.6154C32.2235 65.1274 31.4549 66.3118 30.3209 67.1686C29.1869 68.0254 27.7001 68.4538 25.8605 68.4538ZM27.5615 64.5226C28.3931 64.5226 29.0483 64.3084 29.5271 63.88C30.0311 63.4516 30.2831 62.9098 30.2831 62.2546C30.2831 61.549 30.0311 60.9946 29.5271 60.5914C29.0483 60.1882 28.3931 59.9866 27.5615 59.9866C26.7299 59.9866 26.0747 60.1882 25.5959 60.5914C25.1171 60.9946 24.8777 61.549 24.8777 62.2546C24.8777 62.9098 25.1171 63.4516 25.5959 63.88C26.0747 64.3084 26.7299 64.5226 27.5615 64.5226ZM47.4803 68.2648C45.4391 68.2648 43.8263 67.7608 42.6419 66.7528C41.4827 65.7448 40.9031 64.0942 40.9031 61.801V49.705L40.8275 49.4782L41.9615 45.0178H46.4219V60.5914C46.4219 61.4482 46.6235 62.0656 47.0267 62.4436C47.4299 62.7964 47.9591 62.9728 48.6143 62.9728C48.9923 62.9728 49.3451 62.9476 49.6727 62.8972C50.0255 62.8216 50.3153 62.746 50.5421 62.6704V67.849C50.1137 67.975 49.6475 68.0758 49.1435 68.1514C48.6647 68.227 48.1103 68.2648 47.4803 68.2648ZM38.0303 54.5434V49.4782H50.5421V54.5434H38.0303ZM54.2262 67.9624V42.2206H59.745V67.9624H54.2262ZM65.9442 67.9624V57.0004C65.9442 55.942 65.7552 55.249 65.3772 54.9214C64.9992 54.5686 64.4952 54.3922 63.8652 54.3922C63.336 54.3922 62.7816 54.5056 62.202 54.7324C61.6476 54.934 61.1058 55.2238 60.5766 55.6018C60.0474 55.9798 59.5812 56.4082 59.178 56.887L57.5526 52.9936C58.2078 52.2628 58.9512 51.595 59.7828 50.9902C60.6144 50.3854 61.5216 49.9066 62.5044 49.5538C63.4872 49.201 64.5204 49.0246 65.604 49.0246C66.8388 49.0246 67.8468 49.2388 68.628 49.6672C69.4092 50.0704 70.0014 50.6374 70.4046 51.3682C70.833 52.099 71.1102 52.9306 71.2362 53.863C71.3874 54.7702 71.463 55.7152 71.463 56.698V67.9624H65.9442ZM80.7508 67.9624H75.232V49.4782H80.7508V67.9624ZM74.7406 43.657C74.7406 42.6742 75.0304 41.8804 75.61 41.2756C76.2148 40.6708 77.0086 40.3684 77.9914 40.3684C78.9742 40.3684 79.7554 40.6708 80.335 41.2756C80.9398 41.8804 81.2422 42.6742 81.2422 43.657C81.2422 44.6146 80.9398 45.3958 80.335 46.0006C79.7554 46.5802 78.9742 46.87 77.9914 46.87C77.0086 46.87 76.2148 46.5802 75.61 46.0006C75.0304 45.3958 74.7406 44.6146 74.7406 43.657ZM86.0393 67.9624V48.2686C86.0393 46.8826 86.2913 45.6982 86.7953 44.7154C87.3245 43.7326 88.0553 42.9892 88.9877 42.4852C89.9453 41.956 91.0541 41.6914 92.3141 41.6914C92.9693 41.6914 93.5489 41.7292 94.0529 41.8048C94.5569 41.8804 94.9601 41.956 95.2625 42.0316V47.059C95.0357 47.0086 94.7837 46.9582 94.5065 46.9078C94.2545 46.8574 93.9395 46.8322 93.5615 46.8322C92.9315 46.8322 92.4401 47.0212 92.0873 47.3992C91.7597 47.752 91.5959 48.3316 91.5959 49.138V67.9624H86.0393ZM94.8467 55.1104H83.5445V50.0452H94.8467V55.1104ZM103.236 66.5638L95.8271 49.4782H101.422L108.452 65.7322L103.236 66.5638ZM99.2669 75.1444L110.418 49.4782H116.012L104.899 75.1444H99.2669Z"
                                fill="#4696E6"
                            />
                        </svg>
                    </td>
                    <td class="badge">Sertifikat <br>Penyelesaian</td>
                </tr>
            </table>

            <!-- Content -->
            <div class="content">
                <p class="content1">diberikan kepada</p>
                <h1>Danang Wahyu Utomo</h1>
                <p class="content2">atas kelulusannya pada kelas</p>
                <b>Dasar Pemrograman dengan Website</b>
            </div>

            <table>
                <tr>
                    <td>
                        <!-- Footer -->
                        <div class="footer">
                            <p>23 Desember 2024</p>
                            <p><strong>Khafidha Sukma Dewi</strong></p>
                            <img width="80"
                            src="/media/illustrations/ttd.png"
                            alt="Khafidha Sukma Dewi"
                            />
                            <p>CEO Pathify</p>
                        </div>
                    </td>
                    <td>
                        <!-- Decorative -->
                        <div class="decorative">
                            <img
                            src="/media/illustrations/certificate.png"
                            alt="Decorative"
                            />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
  </body>
</html>