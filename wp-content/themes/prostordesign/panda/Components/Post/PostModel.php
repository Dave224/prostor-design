<?php

namespace Components\Post;

use Components\User\UserModel;
use Interfaces\Jsonable;
use Helpers\ImageCreator;
use Components\SchemaGenerator\SchemaGenerator;
use Utils\Image;
use Utils\Util;

/**
 * Class PostModel
 * @package Components\Post
 */
class PostModel extends \KT_WP_Post_Base_Model implements Jsonable
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, PostConfig::FORM_PREFIX);
    }

    /** @return UserModel */
    public function getUserModel()
    {
        if (isset($this->userModel)) {
            return $this->userModel;
        }
        return $this->userModel = new UserModel($this->getAuthorId());
    }

    public function getSingularName()
    {
        return $this->getPostTypeObject()->labels->singular_name;
    }

    public function getPostAuthorName()
    {
        return $this->getAuthor()->getDisplayName();
    }

    public function getPostAuthorDescription()
    {
        return $this->getAuthor()->getDescription();
    }

    public function getAuthorImageSrc()
    {
        return $this->getUserModel()->getUserImage();
    }

    public function getPostCommentsCount()
    {
        $CommentsCount = get_comments_number($this->getPostId());

        if ($CommentsCount == 1) {
            return " " . $CommentsCount . " komentář";
        } else if ($CommentsCount == 2 || $CommentsCount == 3 || $CommentsCount == 4) {
            return " " . $CommentsCount . " komentáře";
        } else {
            return " " . $CommentsCount . " komentářů";
        }
    }

    public function getPostTags()
    {
        return wp_get_post_tags($this->getPostId());
    }

    public function tryGetJsonLdData()
    {
        $data = [
            "@context" => "http://schema.org",
            "@type" => "NewsArticle",
            "mainEntityOfPage" => [
                "@type" => "WebPage",
            ],
            "headline" => $this->getTitle(),
            "articleBody" => $this->getExcerpt(),
            "author" => $this->getAuthor()->getDisplayName(),
            "url" => $this->getPermalink(),
        ];
        SchemaGenerator::insertThumbnail($data, $this);
        SchemaGenerator::insertDates($data, $this);
        SchemaGenerator::insertPublisher($data, $this);
        return $data;
    }

    // ----------- issety -------------------------------

    public function isPostTags()
    {
        return Util::arrayIssetAndNotEmpty($this->getPostTags());
    }
}
