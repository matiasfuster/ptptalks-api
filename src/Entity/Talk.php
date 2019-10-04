<?php

namespace Solcre\ptptalks\Entity;

use Solcre\ptptalks\Exception\InvalidFilenameException;

class Talk
{

    protected $filename;
    protected $speaker;
    protected $avatar;
    protected $title;
    protected $image;
    protected $slides;
    protected $tags;

    

    /**
     * Get the value of filename
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of filename
     *
     * @return  self
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get the value of speaker
     */
    public function getSpeaker()
    {
        return $this->speaker;
    }

    /**
     * Set the value of speaker
     *
     * @return  self
     */
    public function setSpeaker($speaker)
    {
        $this->speaker = $speaker;

        return $this;
    }

    /**
     * Get the value of avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of slides
     */
    public function getSlides()
    {
        return $this->slides;
    }

    /**
     * Set the value of slides
     *
     * @return  self
     */
    public function setSlides($slides)
    {
        $this->slides = $slides;

        return $this;
    }

    /**
     * Get the value of tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the value of tags
     *
     * @return  self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Return the id of the talk
     *
     * @return int
     */
    public function getId()
    {
        $id = explode('.json', basename($this->filename))[0];
        if (!is_numeric($id)) {
            throw new InvalidFilenameException('Filename must match Ymd.json format.');
        }
        return (int)$id;
    }

    public function getDate()
    {
        return date_create_from_format('Ymd', $this->getId());
    }

    /**
     * Constructor
     *
     * @param string $filename
     * @param string $speaker
     * @param string $title
     * @param Array $tags
     * @param string $slides
     * @param string $image
     * @param string $avatar
     */
    public function __construct(
        $filename,
        $speaker,
        $title,
        Array $tags,
        $slides = "",
        $image = "",
        $avatar = ""
    ) {
        $this->setFilename($filename);
        $this->setSpeaker($speaker);
        $this->setTitle($title);
        $this->setTags($tags);
        $this->setSlides($slides);
        $this->setImage($image);
        $this->setAvatar($avatar);
    }

    public function toArray()
    {
        return [
            "id" => $this->getId(),
            "date" => $this->getDate(),
            "speaker" => $this->getSpeaker(),
            "title" => $this->getTitle(),
            "tags" => $this->getTags(),
            "slides" => $this->getSlides(),
            "image" => $this->getImage(),
            "avatar" => $this->getAvatar()
        ];
    }
}
