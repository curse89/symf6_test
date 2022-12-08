<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Bridge\Telegram\Reply\Markup\Button\InlineKeyboardButton;
use Symfony\Component\Notifier\Bridge\Telegram\Reply\Markup\InlineKeyboardMarkup;
use Symfony\Component\Notifier\Bridge\Telegram\TelegramOptions;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
use Symfony\Component\Notifier\Message\ChatMessage;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\NoRecipient;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/i', name: 'app_invoice')]
    public function index(NotifierInterface $notifier, ChatterInterface $chatter): Response
    {
        $notification = (new Notification('New Invoice', ['chat/telegram']))
            ->content('You got a new invoice for 15 EUR.');
        $message = (new ChatMessage('test'))
            ->transport('telegram');


        $telegramOptions = (new TelegramOptions())
            ->parseMode('MarkdownV2')
            ->disableWebPagePreview(true)
            ->disableNotification(false)
            ->replyMarkup((new InlineKeyboardMarkup())
                ->inlineKeyboard([
                    (new InlineKeyboardButton('Visit symfony.com'))
                        ->url('https://symfony.com/'),
                ])
            );
        $message->options($telegramOptions);
        $chatter->send($message);


        $notifier->send($notification, new NoRecipient());
        return $this->render('invoice/index.html.twig', [
            'controller_name' => 'InvoiceController',
        ]);
    }
}
