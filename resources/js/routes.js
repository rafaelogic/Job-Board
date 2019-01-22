import Main from './components/Main.vue'
import Login from "./components/auth/Login.vue"

import JobsMain from "./components/jobs/Main.vue"
import JobLists from "./components/jobs/JobLists.vue"
import SearchResultLists from "./components/jobs/SearchResultLists.vue"
import NewJob from "./components/jobs/new/Main.vue"
import ViewJob from "./components/jobs/View.vue"

import FourOFour from './components/_templates/FourOFour.vue'

export const routes = [
    {
        path:'/',
        component: Main,
        children:[
            {
                path: "/",
                redirect: "/jobs",
            },{
                path: "jobs",
                component: JobsMain,
                children: [
                    {
                        path: "/",
                        component: JobLists
                    },{
                        path: "new",
                        component: NewJob,
                    },{
                        path: ":slug",
                        component: ViewJob
                    },{
                        path: 'job-type/:slug',
                        component: SearchResultLists
                    },{
                        path: 'category/:slug',
                        component: SearchResultLists
                    },{
                        path: 'city/:slug',
                        component: SearchResultLists
                    },{
                        path: 'source/:slug',
                        component: SearchResultLists
                    }
                ]
            },{
                path: "login",
                component: Login
            },{
                path: '*',
                component: FourOFour
            }
        ]
    }
]
