<template>
    <ion-page>
      <ion-header>
        <ion-toolbar>
          <ion-buttons slot="start">
            <ion-back-button defaultHref="/"></ion-back-button>
          </ion-buttons>
          <ion-title>AirBn'World</ion-title>
        </ion-toolbar>
      </ion-header>
  
      <ion-content class="ion-padding">
        <div class="confirmation-container">
          <ion-card class="confirmation-card">
            <ion-card-header>
              <ion-card-title class="ion-text-center">Confirmation d'abonnement</ion-card-title>
            </ion-card-header>
  
            <ion-card-content>
              <ion-item>
                <ion-label>Abonnement </ion-label>
                <ion-note slot="end">Solo (1 pers.)</ion-note>
              </ion-item>
  
              <ion-item>
                <ion-label>Date d'abonnement</ion-label>
                <ion-note slot="end">12/12/2012</ion-note>
              </ion-item>
  
              <ion-item>
                <ion-label>Carte</ion-label>
                <ion-note slot="end">#### #### #### 4242</ion-note>
              </ion-item>
  
              <ion-item>
                <ion-label>Prix HT</ion-label>
                <ion-note slot="end">100 €</ion-note>
              </ion-item>
  
              <ion-item>
                <ion-label>TVA (20%)</ion-label>
                <ion-note slot="end">20 €</ion-note>
              </ion-item>
  
              <ion-item>
                <ion-label><strong>TOTAL TTC</strong></ion-label>
                <ion-note slot="end"><strong>120 € / mois</strong></ion-note>
              </ion-item>
  
              <ion-text class="ion-text-center">
                Abonnement mensuel avec réengagement automatique.<br>
                Prochain renouvellement : <strong>12/12/2012</strong>
              </ion-text>
              <ion-button expand="full" class="custom-button" router-link="/">Accéder au service</ion-button>
            </ion-card-content>
          </ion-card>
        </div>
      </ion-content>
    </ion-page>
  </template>
  
  <script setup>
  import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent, IonCard, IonCardHeader, IonCardTitle, IonCardContent, IonItem, IonLabel, IonNote, IonButton, IonButtons, IonBackButton, IonText } from '@ionic/vue';
  </script>
  
  <style scoped>
  .confirmation-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
  }
  
  .confirmation-card {
    max-width: 400px;
    width: 100%;
    background: #ffffffce;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }
  
  .custom-button {
    --background: #15854b;
    --border-radius: 20px;
    --color: #ffffff;
    --padding-start: 20px;
    --padding-end: 20px;
    --transition: background-color 0.3s ease, color 0.3s ease;
    margin-top: 20px;
  }
  
  .custom-button:hover {
    --background: #0f6d3b;
  }
  </style>
  