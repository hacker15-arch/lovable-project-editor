import { Card } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { MapPin, Home, Bath, Car } from "lucide-react";

interface PropertyCardProps {
  id: number;
  image: string;
  title: string;
  location: string;
  price: number;
  bedrooms: number;
  bathrooms: number;
  parking: boolean;
  type: string;
}

const PropertyCard = ({ 
  image, 
  title, 
  location, 
  price, 
  bedrooms, 
  bathrooms, 
  parking, 
  type 
}: PropertyCardProps) => {
  return (
    <Card className="house-card overflow-hidden border-0 shadow-lg">
      <div className="house-3d">
        <div className="relative overflow-hidden">
          <img 
            src={image} 
            alt={title}
            className="w-full h-64 object-cover transition-transform duration-500 hover:scale-110"
          />
          <Badge className="absolute top-4 left-4 price-badge">
            {type}
          </Badge>
        </div>
        
        <div className="p-6 space-y-4">
          <div>
            <h3 className="text-xl font-bold text-foreground mb-2">{title}</h3>
            <div className="flex items-center text-muted-foreground">
              <MapPin className="w-4 h-4 mr-2" />
              <span className="text-sm">{location}</span>
            </div>
          </div>
          
          <div className="flex items-center justify-between text-sm text-muted-foreground">
            <div className="flex items-center space-x-4">
              <div className="flex items-center">
                <Home className="w-4 h-4 mr-1" />
                <span>{bedrooms} BHK</span>
              </div>
              <div className="flex items-center">
                <Bath className="w-4 h-4 mr-1" />
                <span>{bathrooms}</span>
              </div>
              {parking && (
                <div className="flex items-center">
                  <Car className="w-4 h-4 mr-1" />
                  <span>Parking</span>
                </div>
              )}
            </div>
          </div>
          
          <div className="flex items-center justify-between pt-4 border-t border-border">
            <div>
              <div className="text-2xl font-bold text-primary">
                ₹{price.toLocaleString('en-IN')}/mo
              </div>
              <div className="text-xs text-muted-foreground">+ Security Deposit</div>
            </div>
            <Button className="hero-btn">
              View Details
            </Button>
          </div>
        </div>
      </div>
    </Card>
  );
};

export default PropertyCard;