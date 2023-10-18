tailwind.config = {
    theme: {
        screens: {
            'sm': '640px',
            // => @media (min-width: 640px) { ... }

            'md': '768px',
            // => @media (min-width: 768px) { ... }

            'lg': '1024px',
            // => @media (min-width: 1024px) { ... }

            'xl': '1280px',
            // => @media (min-width: 1280px) { ... }

            '2xl': '1536px',
            // => @media (min-width: 1536px) { ... }
        },
        extend: {
            fontSize: {
                xxs: ['0.625rem', '0.75rem'],
                xxxs: ['0.5rem', '0.5rem'],
            },
            borderWidth: {
                '3': '3px',
            },
            spacing: {
                15: '3.75rem'
            },
            colors: {
                primary: {
                    100: '#0F345E',
                    200: '#1089C0',
                    300: '#6BD1FF',
                    400: '#0F4B89',
                    500: '#036ADF',
                    600: '#A3CEFF',
                    700: '#00CAFF',
                    800: '#D6F6FF',
                    900: 'rgba(15, 52, 94, 0.8)'
                },
                secondary: {
                    100: '#FFA110',
                    200: '#FFE7C1',
                },
                tertiary: {
                    100: '#E906BB',
                    200: '#FFCAFA',
                },
                neutral: {
                    10: '#EDEEEE',
                    20: '#FAFAFA',
                    30: '#92989B',
                    90: '#939393',
                },
                gray: {
                    100: '#FAFAFA',
                }
            }
        }
    }
}
const useState = function(initial){
    let nowData = {
        value: initial,
    }
    let listeners = [];
    let get = function(){
        return nowData.value;
    }
    let set = function(val){
        if(nowData.value !== val){
            emitOnChange(nowData.value, val);
            nowData.value = val;
        }
    }
    let on = function(callback){
        if(typeof callback === "function")
            listeners.push(callback)
        else
            throw "Callback Parameter is not a function";
    }
    let emitOnChange = function(newVal, oldVal){
        listeners.forEach((listener) => {
            listener(newVal, oldVal);
        });
    }
    return [get, set, on];
};
let [getNavOpen, setNavOpen, onNavChange] = useState(false);
onNavChange((newVal)=>{
    if(newVal){
        document.getElementById('nav_menu').classList.remove('hidden');
        document.getElementById('nav_menu').classList.add('block')
        document.getElementById('nav_toggle').classList.add('show-toggle')
    } else {
        document.getElementById('nav_menu').classList.add('hidden');
        document.getElementById('nav_menu').classList.remove('block');
        document.getElementById('nav_toggle').classList.remove('show-toggle')
    }
})
