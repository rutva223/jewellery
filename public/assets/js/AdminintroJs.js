// English and Hindi messages
var messages = {
   "en": {
        "welcome": "Welcome to MintCoin.",
        "intro_first": "Here you can see your Email ID and your unique ID.",
        "theme_changes": "This is the theme change button. You can switch between dark and light themes with a single click.",
        "intro_thired": "This is our dashboard where you can view your USDT balance and additional data.",
        "intro_foure": "Here you can see your transaction details.",
        "intro_five": "This is our Bank Master section. You can add your bank and see your bank list.",
        "intro_six": "This is the QR user bank details section. Here, you can view user bank details, request rejection, and confirmation.",
        "intro_seven": "This is the QR Owner section. Here, you can add your QR users.",
        "intro_eighth": "This is the Merchants section. Here, you can view all your merchants and click the view button to see merchant orders.",
        "intro_nine": "This is the User Support Ticket section. Here, you can view user support tickets.",
        "intro_ten": "This is the Merchant Support Ticket section. Here, you can view merchant support tickets.",
        "intro_eleven": "Here, you can set your SMTP details.",
        "intro_twelve": "Here, you can see all cron job details.",
        "intro_thirteen": "In this section, you can add coins, view coin history, and delete coin history."
        // "intro_fourteen": ""
    },
   "hi": {
        "welcome": "MintCoin में आपका स्वागत है।",
        "intro_first": "यहाँ आप अपना ईमेल आईडी और आपका अद्वितीय आईडी देख सकते हैं।",
        "theme_changes": "यह थीम परिवर्तन बटन है। आप एक क्लिक में डार्क और लाइट थीम के बीच स्विच कर सकते हैं।",
        "intro_thired": "यह हमारा डैशबोर्ड है जहाँ आप अपना USDT बैलेंस और अतिरिक्त डेटा देख सकते हैं।",
        "intro_foure": "यहाँ आप अपने लेन-देन का विवरण देख सकते हैं।",
        "intro_five": "यह हमारा बैंक मास्टर सेक्शन है। आप यहाँ अपने बैंक को जोड़ सकते हैं और बैंक सूची देख सकते हैं।",
        "intro_six": "यह QR उपयोगकर्ता बैंक विवरण अनुभाग है। यहाँ, आप उपयोगकर्ताओं के बैंक विवरण अनुरोध को दिखा सकते हैं और अनुरोध को अस्वीकार और पुष्टि कर सकते हैं।",
        "intro_seven": "यह QR मालिक अनुभाग है। यहाँ, आप अपने QR उपयोगकर्ताओं को जोड़ सकते हैं।",
        "intro_eighth": "यह व्यापारी उपयोगकर्ता अनुभाग है। यहाँ, आप अपने सभी व्यापारियों को देख सकते हैं और व्यू बटन पर क्लिक करके व्यापारी के आदेश को देख सकते हैं।",
        "intro_nine": "यह उपयोगकर्ता सहायता टिकट अनुभाग है। यहाँ, आप उपयोगकर्ताओं की सहायता देख सकते हैं।",
        "intro_ten": "यह व्यापारी सहायता टिकट अनुभाग है। यहाँ, आप व्यापारियों की सहायता देख सकते हैं।",
        "intro_eleven": "यहाँ, आप अपने SMTP विवरण सेट कर सकते हैं।",
        "intro_twelve": "यहाँ, आप सभी क्रॉन विवरण देख सकते हैं।",
        "intro_thirteen": "इस अनुभाग में, आप सिक्का जोड़ सकते हैं, सिक्का इतिहास देख सकते हैं और सिक्का इतिहास हटा सकते हैं।"
        // Add more Hindi messages as needed
    }
};

// Set the default language to English
var currentLanguage = "hi";

// Intro.js configuration
var intro = introJs().setOptions({
    nextLabel: "Next",
    prevLabel: "Back",
    doneLabel: "Done",
    tooltipClass: "",
    exitOnOverlayClick: false,
    showStepNumbers: false,
    steps: [
        {
            intro: messages[currentLanguage]["welcome"]
        },
        {
            element: document.querySelector("#intro_first"),
            intro: messages[currentLanguage]["intro_first"]
        },
        {
            element: document.querySelector("#theme_changes"),
            intro: messages[currentLanguage]["theme_changes"]
        },
        {
            element: document.querySelector("#intro_thired"),
            intro: messages[currentLanguage]["intro_thired"]
        },
        {
            element: document.querySelector("#intro_foure"),
            intro: messages[currentLanguage]["intro_foure"]
        },
        {
            element: document.querySelector("#intro_five"),
            intro: messages[currentLanguage]["intro_five"]
        },
        {
            element: document.querySelector("#intro_six"),
            intro: messages[currentLanguage]["intro_six"]
        },
        {
            element: document.querySelector("#intro_seven"),
            intro: messages[currentLanguage]["intro_seven"]
        },
        {
            element: document.querySelector("#intro_eighth"),
            intro: messages[currentLanguage]["intro_eighth"]
        },
        {
            element: document.querySelector("#intro_nine"),
            intro: messages[currentLanguage]["intro_nine"]
        },
        {
            element: document.querySelector("#intro_ten"),
            intro: messages[currentLanguage]["intro_ten"]
        },
        {
            element: document.querySelector("#intro_eleven"),
            intro: messages[currentLanguage]["intro_eleven"]
        },
        {
            element: document.querySelector("#intro_twelve"),
            intro: messages[currentLanguage]["intro_twelve"]
        },
        {
            element: document.querySelector("#intro_thirteen"),
            intro: messages[currentLanguage]["intro_thirteen"]
        },
        // Add more steps using English or Hindi messages as needed
    ]
}).oncomplete(() => document.cookie = "intro-complete=true");

// Function to start the intro
var start = () => intro.start();

// Event listener to start the intro on button click
window.addEventListener("load", () => {
    // Show language selection popup

    // Start the intro based on the selected language
    document.getElementById("startIntro").addEventListener("click", function() {
        $('#languagePopup').modal('hide');
        var selectedLanguage = document.getElementById("languageSelect").value;
        currentLanguage = selectedLanguage;
        intro.setOptions({
            steps: [
                {
                    intro: messages[currentLanguage]["welcome"]
                },
                {
                    element: document.querySelector("#intro_first"),
                    intro: messages[currentLanguage]["intro_first"]
                },
                {
                    element: document.querySelector("#theme_changes"),
                    intro: messages[currentLanguage]["theme_changes"]
                },
                {
                    element: document.querySelector("#intro_thired"),
                    intro: messages[currentLanguage]["intro_thired"]
                },
                {
                    element: document.querySelector("#intro_foure"),
                    intro: messages[currentLanguage]["intro_foure"]
                },
                {
                    element: document.querySelector("#intro_five"),
                    intro: messages[currentLanguage]["intro_five"]
                },
                {
                    element: document.querySelector("#intro_six"),
                    intro: messages[currentLanguage]["intro_six"]
                },
                {
                    element: document.querySelector("#intro_seven"),
                    intro: messages[currentLanguage]["intro_seven"]
                },
                {
                    element: document.querySelector("#intro_eighth"),
                    intro: messages[currentLanguage]["intro_eighth"]
                },
                {
                    element: document.querySelector("#intro_nine"),
                    intro: messages[currentLanguage]["intro_nine"]
                },
                {
                    element: document.querySelector("#intro_ten"),
                    intro: messages[currentLanguage]["intro_ten"]
                },
                {
                    element: document.querySelector("#intro_eleven"),
                    intro: messages[currentLanguage]["intro_eleven"]
                },
                {
                    element: document.querySelector("#intro_twelve"),
                    intro: messages[currentLanguage]["intro_twelve"]
                },
                {
                    element: document.querySelector("#intro_thirteen"),
                    intro: messages[currentLanguage]["intro_thirteen"]
                },
                // {
                //     element: document.querySelector("#intro_fourteen"),
                //     intro: messages[currentLanguage]["intro_fourteen"]
                // },
                // Add more steps using English or Hindi messages as needed
            ]
        });
        start();
        document.getElementById("languagePopup").style.display = "none";
    });
});
