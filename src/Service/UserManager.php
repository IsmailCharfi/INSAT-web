<?php


namespace App\Service;


use Symfony\Component\Security\Core\Security;

class UserManager
{
    public const ROLE_USER = "ROLE_USER";
    public const ROLE_ENSEIGNANT = "ROLE_ENSEIGNANT";
    public const ROLE_ETUDIANT = "ROLE_ETUDIANT";
    public const ROLE_OPERATEUR = "ROLE_OPERATEUR";
    public const ROLE_ADMIN = "ROLE_ADMIN";
    public const ROLE_SCOLARITE = "ROLE_SCOLARITE";
    public const ROLE_VALIDATEUR = "ROLE_VALIDATEUR";
    public const ROLE_EDITEUR_SITE = "ROLE_EDITEUR_SITE";
    public const ROLE_EDITEUR_BASE = "ROLE_EDITEUR_BASE";

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    private function hasRole($role): bool
    {
        return $this->security->isGranted($role) ;
    }

    public function isAuthenticated(): bool
    {
        return $this->hasRole(self::ROLE_USER);
    }

    public function isEtudiant(): bool
    {
        return $this->hasRole(self::ROLE_ETUDIANT) ;
    }

    public function isEnseignant(): bool
    {
        return $this->hasRole(self::ROLE_ENSEIGNANT) ;
    }

    public function isOperateur(): bool
    {
        return $this->hasRole(self::ROLE_OPERATEUR) ;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(self::ROLE_ADMIN) ;
    }

    public function isScolarite(): bool
    {
        return $this->hasRole(self::ROLE_SCOLARITE) ;
    }

    public function isValidateur(): bool
    {
        return $this->hasRole(self::ROLE_VALIDATEUR) ;
    }

    public function isEditeurSite(): bool
    {
        return $this->hasRole(self::ROLE_EDITEUR_SITE) ;
    }

    public function isEditeurBase(): bool
    {
        return $this->hasRole(self::ROLE_EDITEUR_BASE) ;
    }



}