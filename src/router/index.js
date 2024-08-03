import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '@/pages/login/LoginPage.vue'
import SignupPage from '@/pages/signup/SignupPage.vue'
import HomePage from '@/pages/home/HomePage.vue'
import PersonalDataPage from '@/pages/signup/components/PersonalDataPage.vue'
import AdoptPage from '@/pages/adopt/AdoptPage.vue'
import SecondhandPage from '@/pages/secondhand/SecondhandPage.vue'
import SecondhandinfoPage from '@/pages/secondhandsinfo/SecondhandinfoPage.vue'
import ResetPasswordPage from '@/pages/resetpassword/ResetPasswordPage.vue'
import PublishPage from '@/pages/publish/PublishPage.vue'
import PetdataPage from '@/pages/petdata/PetdataPage.vue'
import LostHelpPage from '@/pages/losthelp/Losthelp.vue'
import LostHelpDataPage from '@/pages/losthelpdata/LosthelpdataPage.vue'
import SystemrebonsePage from '@/pages/systemrebonse/SystemrebonsePage.vue'
import QuestionrebonsePage from '@/pages/questionrebonse/QuestionrebonsePage.vue'
import ReviewPage from '@/pages/questionrebonse/ReviewPage.vue'
import ReviewquestionPage from '@/pages/questionrebonse/components/Reviewquestion.vue'
import MyaccountPage from '@/pages/myaccount/MyaccountPage.vue'
import AddproductPage from '@/pages/addproduct/AddproductPage.vue'
import MessagePage from '@/pages/message/MessagePage.vue'
import MessagelistPage from '@/pages/message/Messagelist.vue'
import BeaconPage from '@/pages/beacon/BeaconPage.vue'
import QuestionlistPage from '@/pages/questionrebonse/QuestionlistPage.vue'
import ReviewlistPage from '@/pages/questionrebonse/Reviewlist.vue'
import PublicAdoptionPage from '@/pages/publicadoption/PublicAdoption.vue'
import PublicAdoptiondataPage from '@/pages/publicadoption/component/PublicAdoptiondata.vue'
import MypostPage from '@/pages/mypost/MypostPage.vue'
import FrequencyPage from '@/pages/frequency/FrequencyPage.vue'
import ReturnlistPage from '@/pages/returnlist/ReturnlistPage.vue'
import QuestionrebonseInfoPage from '@/pages/questionrebonseinfo/QuestionrebonseInfoPage.vue'

const routes = [

  {
    path: '/home',
    name: 'home',
    component: HomePage
  },
  {
    path: '/',
    name: 'login',
    component: LoginPage
  },
  {
    path: '/signup',
    name: 'signup',
    component: SignupPage
  },
  {
    path: '/personaldata',
    name: 'personaldata',
    component: PersonalDataPage
  },
  {
    path: '/adopt',
    name: 'adopt',
    component: AdoptPage
  },
  {
    path: '/secondhand',
    name: 'secondhand',
    component: SecondhandPage
  },
  {
    path: '/secondhandinfo',
    name: 'secondhandinfo',
    component: SecondhandinfoPage
  },
  {
    path: '/resetpassword',
    name: 'resetpassword',
    component: ResetPasswordPage
  },
  {
    path: '/publish',
    name: 'publish',
    component: PublishPage
  },
  {
    path: '/petdata',
    name: 'petdata',
    component: PetdataPage,
    props: true
  },
  {
    path: '/losthelp',
    name: 'losthelp',
    component: LostHelpPage
  },
  {
    path: '/losthelpdata',
    name: 'losthelpdata',
    component: LostHelpDataPage,
    props: true
  },
  {
    path: '/systemrebonse',
    name: 'systemrebonse',
    component: SystemrebonsePage
  },
  {
    path: '/questionrebonse',
    name: 'questionrebonse',
    component: QuestionrebonsePage
  },
  {
    path: '/review',
    name: 'review',
    component: ReviewPage
  },
  {
    path: '/reviewlist',
    name: 'reviewlist',
    component: ReviewlistPage
  },
  {
    path: '/reviewquestion',
    name: 'reviewquestion',
    component: ReviewquestionPage
  },
  {
    path: '/myaccount',
    name: 'myaccount',
    component: MyaccountPage
  },
  {
    path: '/addproduct',
    name: 'addproduct',
    component: AddproductPage
  },  
  {
    path: '/message',
    name: 'message',
    component: MessagePage
  },
  {
    path: '/messagelist',
    name: 'messagelist',
    component: MessagelistPage
  },
  {
    path: '/beacon',
    name: 'beacon',
    component: BeaconPage
  },
  {
    path: '/questionlist',
    name: 'questionlist',
    component: QuestionlistPage
  },
  {
    path: '/publicadoption',
    name: 'publicadoption',
    component: PublicAdoptionPage
  },
  {
    path: '/publicadoptiondata',
    name: 'publicadoptiondata',
    component: PublicAdoptiondataPage
  },
  {
    path: '/mypost',
    name: 'mypost',
    component: MypostPage
  },
  {
    path: '/frequency',
    name: 'frequency',
    component: FrequencyPage
  },
  {
    path: '/returnlist',
    name: 'returnlist',
    component: ReturnlistPage
  },
  {
    path: '/questionrebonseinfo',
    name: 'questionrebonseinfo',
    component: QuestionrebonseInfoPage
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
