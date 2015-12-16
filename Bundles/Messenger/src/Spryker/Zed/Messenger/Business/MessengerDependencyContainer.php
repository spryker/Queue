<?php
/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Messenger\Business;

use Spryker\Zed\Messenger\Business\Model\InMemoryMessageTray;
use Spryker\Zed\Messenger\Business\Model\MessageTrayInterface;
use Spryker\Zed\Messenger\Business\Model\SessionMessageTray;
use Generated\Zed\Ide\FactoryAutoCompletion\MessengerBusiness;
use Spryker\Zed\Messenger\MessengerDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessDependencyContainer;
use Spryker\Zed\Messenger\MessengerConfig;
use Spryker\Zed\Glossary\Business\GlossaryFacade;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @method MessengerConfig getConfig()
 */
class MessengerDependencyContainer extends AbstractBusinessDependencyContainer
{

    /**
     * @return MessageTrayInterface
     */
    public function createMessageTray()
    {
        $messageTry = $this->getConfig()->getTray();
        if ($messageTry === MessengerConfig::IN_MEMORY_TRAY) {
            return $this->createInMemoryMessageTray();
        }

        return $this->createSessionMessageTray();
    }

    /**
     * @return InMemoryMessageTray
     */
    public function createInMemoryMessageTray()
    {
        return new InMemoryMessageTray($this->getGlossaryFacade());
    }

    /**
     * @return SessionMessageTray
     */
    public function createSessionMessageTray()
    {
        return new SessionMessageTray($this->createSession(), $this->getGlossaryFacade());
    }

    /**
     * @return SessionInterface
     */
    public function getSession()
    {
        return $this->getProvidedDependency(MessengerDependencyProvider::SESSION);
    }

    /**
     * @return GlossaryFacade
     */
    public function getGlossaryFacade()
    {
        return $this->getProvidedDependency(MessengerDependencyProvider::FACADE_GLOSSARY);
    }

}