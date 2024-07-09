import { createRouter, createWebHistory } from "@ionic/vue-router";
import Home from "../views/Home.vue";
import Contact from "../views/Contact.vue";
import Login from "../views/Login.vue";
import Signup from "../views/Signup.vue";
import Subscription from "../views/Subscription.vue";
import News from "../views/News.vue";
import NewsDetail from "../views/NewsDetail.vue";
import PaymentCancel from "../views/PaymentCancel.vue";
import PaymentSuccess from "../views/PaymentSuccess.vue";
import PrivacyPolicy from "../views/PrivacyPolicy.vue";
import Terms from "../views/Terms.vue";
import Legal from "../views/Legal.vue";
import Account from "../views/Account.vue";
import SubscriptionConfirmation from "../views/SubscriptionConfirmation.vue";
import SubscriptionSummary from "../views/SubscriptionSummary.vue";
import { useAuthStore } from "@/stores/auth";

const routes = [
    {
        path: "/",
        redirect: "/home",
    },
    {
        path: "/home",
        name: "Home",
        component: Home,
    },
    {
        path: "/contact",
        name: "Contact",
        component: Contact,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: { requiresGuest: true },
    },
    {
        path: "/signup",
        name: "Signup",
        component: Signup,
        meta: { requiresGuest: true },
    },
    {
        path: "/subscription",
        name: "Subscription",
        component: Subscription,
    },
    {
        path: "/news",
        name: "News",
        component: News,
    },
    {
        path: "/newsdetail/:id",
        name: "NewsDetail",
        component: NewsDetail,
    },
    {
        path: "/paymentcancel",
        name: "PaymentCancel",
        component: PaymentCancel,
        meta: { requiresAuth: true },
    },
    {
        path: "/paymentsuccess",
        name: "PaymentSuccess",
        component: PaymentSuccess,
        meta: { requiresAuth: true },
    },
    {
        path: "/privacypolicy",
        name: "PrivacyPolicy",
        component: PrivacyPolicy,
    },
    {
        path: "/terms",
        name: "Terms",
        component: Terms,
    },
    {
        path: "/legal",
        name: "Legal",
        component: Legal,
    },
    {
        path: "/account",
        name: "Account",
        component: Account,
        meta: { requiresAuth: true },
    },
    {
        path: "/subscriptionConfirmation",
        name: "SubscriptionConfirmation",
        component: SubscriptionConfirmation,
        meta: { requiresAuth: true },
    },
    {
        path: "/subscriptionSummary",
        name: "SubscriptionSummary",
        component: SubscriptionSummary,
        meta: { requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    
    const authStore = useAuthStore();
    if (to.meta.requiresAuth && !authStore.isConnected) {
        // si pas connected
        next("/login");
    } else if (to.meta.requiresGuest && authStore.isConnected) {
        // si connecte
        next("/account");
    } else {
        next();
    }
});

export default router;
