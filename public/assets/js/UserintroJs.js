// English and Hindi messages
var messages = {
    "en": {
        "welcome": "Welcome to MintCoin.",
        "intro_first": "Here you can see your Email ID and your user code.",
        "theme_changes": "This is the theme change button. You can switch between dark and light themes with a single click.",
        "intro_thired": "This is our dashboard where you can view your Bank Status and additional data.",
        "intro_foure": "This is our Bank Section.Here, you can view, add, and manage your bank account details.",
        "intro_five": "In this section, you can buy coins and view the history of your coin purchase.",
        "intro_six": "Here, you can see the list of sell coin entries and apply filters to easily find the data.",
        "intro_seven": "This is support ticket section. If you have any queries or are facing problems, you can easily contact the support team using this section.",
        // "intro_fourteen": ""
    },
    "hi": {
        "welcome": "MintCoin में आपका स्वागत है।",
        "intro_first": "यहाँ आप अपना ईमेल आईडी और आपका अद्वितीय आईडी देख सकते हैं।",
        "theme_changes": "यह थीम परिवर्तन बटन है। आप एक क्लिक में डार्क और लाइट थीम के बीच स्विच कर सकते हैं।",
        "intro_thired": "यह हमारा डैशबोर्ड है जहाँ आप अपनी बैंक स्थिति और अतिरिक्त डेटा देख सकते हैं।",
        "intro_foure": "यह हमारा बैंक अनुभाग है। यहां आप अपने बैंक खाते का विवरण देख सकते हैं, जोड़ सकते हैं और प्रबंधित कर सकते हैं।",
        "intro_five": "इस अनुभाग में, आप सिक्के खरीद सकते हैं और अपनी सिक्का खरीद का इतिहास देख सकते हैं।",
        "intro_six": "यहां, आप बेचे गए सिक्कों की प्रविष्टियों की सूची देख सकते हैं और डेटा को आसानी से खोजने के लिए फ़िल्टर लागू कर सकते हैं।",
        "intro_seven": "यह सहायता टिकट अनुभाग है। यदि आपके पास कोई प्रश्न है या आप समस्याओं का सामना कर रहे हैं, तो आप इस अनुभाग का उपयोग करके आसानी से सहायता टीम से संपर्क कर सकते हैं।",
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

        // Add more steps using English or Hindi messages as needed
    ]
}).oncomplete(() => document.cookie = "intro-complete=true");

// Function to start the intro
var start = () => intro.start();

// Event listener to start the intro on button click
window.addEventListener("load", () => {
    // Show language selection popup

    // Start the intro based on the selected language
    document.getElementById("startIntro").addEventListener("click", function () {
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
            ]
        });
        start();
        document.getElementById("languagePopup").style.display = "none";
    });
});
